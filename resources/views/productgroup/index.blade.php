@extends('layouts.master')

@section('content')
    
    <section class="content-header">
      <h1>
        Product Groups    
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class=""><i class="fa fa-circle"></i>Settings</li>
        <li class="active"><i class="fa fa-circle"></i>Product Groups</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="pGroupCtrl">
      <div class='col-md-5'>
        @include('productgroup.create')
      </div>
      <div class='col-md-7'>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">List</h3>
          </div>
          <a href="#" ng-click="getGroups()" class="hide refresh"></a>
          
            <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>  
                <th>Group Name</th> 
                <th style="width: 60px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="gr in groups |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>
                  <td ng-bind="gr.group_name"></td>                  
                  <td>
                    
                    <a href="#" class='group-edit' data-id="@{{gr.group_id}}"><i class="fa fa-pencil"></i></a>
                    <a href="#"><i class="fa fa-trash warning"></i></a>
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
<script src="/angular/controllers/group.js"></script>
<script src="/angular/dirPagination.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.product-group").addClass('active');
  });
  $(document).on('click','.group-edit',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $.get( "product-group/"+id+"/edit", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Edit Group',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  var $this   = $(this);
                  var data = $('#form-product-group').serialize();  
                  $.ajax({
                    url: "/product-group/"+id,
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
