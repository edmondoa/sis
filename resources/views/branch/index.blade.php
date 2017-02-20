@extends('layouts.master')

@section('content')
  <link rel="stylesheet" href="/plugins/iCheck/all.css">
  <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Branches
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class=""><i class="fa fa-circle"></i>Settings</li>
        <li class="active"><i class="fa fa-circle"></i>Branches</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="branchCtrl">
      <div class='col-md-4'>
        @include('branch.create')
      </div>
      <div class='col-md-8'>
        <div class="box">
          <div class="box-header with-border">
            @include('layouts.search')
          </div>
          <a href="#" ng-click="getBranches()" class="hide refresh"></a>
          
            <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>                
                <th class="col-sm-3">Branch Name</th>               
                <th class="col-sm-2">Cluster</th>                
                <th class="col-sm-2">Status</th>
                <th class="col-sm-1">Lock</th>
                <th class="col-sm-1">Suspended</th>
                <th style="width: 40px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="br in branches |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>
                  <td ng-bind="br.branch_name"></td>                 
                  <td ng-bind="br.cluster.cluster_name"></td>                  
                  <td><span ng-class="(br.status =='CLOSE')?'text-red':'text-green'" ng-bind="br.status"></span></td>
                  <td><span ng-bind="(br.lock==1)?'Yes':'No'"></span></td>
                  <td><span ng-bind="(br.suspended==1)?'Yes':'No'"></span></td>
                  <td>
                    <a href="#" class='branch-edit' data-id="@{{br.branch_id}}"><i class="fa fa-pencil"></i></a>                   
                  </td>
                </tr>
              </tbody>
              
            </table>
          </div>
            <!-- /.box-body -->
          <div class="box-footer clearfix">            
            <dir-pagination-controls boundary-links="true" template-url="../angular/dirPagination.tpl.html"></dir-pagination-controls>
          </div>
        </div>
      </div>
    </section>  
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/branch.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.branches").addClass('active');
  });
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
  $(document).on('click','.branch-edit',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $.get( "branches/"+id+"/edit", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Edit Branch',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  var $this   = $(this);
                  var data = $('#form-branches').serialize();  
                  $.ajax({
                    url: "/branches/"+id,
                    method:'PUT',
                    data: data,
                    dataType: 'JSON',
                    success: function(result){
                      if (result['status'] == true) {
                        bootbox.hideAll();
                        message(result);                        
                        $(".refresh").trigger('click');
                      } else {    
                        message(result);                      
                        return false;
                      }
                    },
                    
                  });                 
                  
                  return false;
                }
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
      });
          
    });
  })
</script>
@stop
