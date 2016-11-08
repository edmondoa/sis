@extends('layouts.master')

@section('content')
  <link rel="stylesheet" href="/plugins/iCheck/all.css">
  <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Journals   
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Operations</li>
        <li class="active"><i class="fa fa-circle"></i> Journals</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="journalCtrl">     
      <div class='col-md-10'>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">List</h3>
          </div>
          <a href="#" ng-click="getJournals()" class="hide refresh"></a>
          
            <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th> 
                <th class="col-sm-2">Date</th>               
                <th class="col-sm-3">Doc#</th>               
                <th class="col-sm-2">Type</th> 
                <th class="col-sm-1">Status</th>               
                <th style="width: 40px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="app in journals |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>
                  <td ng-bind="app.approvalable.encode_date"></td>                 
                  <td ng-bind="app.approvalable.doc_no"></td>  
                  <td><span ng-bind="app.approval_type.approval"></span></td> 
                  <td><span class="text-info" ng-bind="app.status"></span></td>
                 
                 
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Action</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Approve<i class='pull-right glyphicon glyphicon-thumbs-up'></i> </a></li>
                        <li><a href="#">Decline<i class='pull-right glyphicon glyphicon-thumbs-down'></i> </a></li>
                        <li><a href="#">Show <i class="pull-right glyphicon glyphicon-eye-open"/></i></a></li>
                      </ul>
                    </div>                  
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
<script src="/angular/controllers/journal.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
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
