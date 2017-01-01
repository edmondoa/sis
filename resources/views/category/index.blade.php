@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <style type="text/css">
    .select2{width:100% !important;}
    </style>
    <section class="content-header">
      <h1>
        Categories     
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class=""><i class="fa fa-circle"></i>Settings</li>
        <li class="active"><i class="fa fa-circle"></i>Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="categoryCtrl">
      <div class='col-md-5'>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">New Category</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Category Name</label>
                  <div class="col-sm-8">                  
                    <input type='text' ng-model="category.category_name" class='form-control category_name' placeholder="Category Name"/>
                 </div>         
              </div> 
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Category Code</label>
                  <div class="col-sm-8">                  
                    <input type='text' ng-model="category.category_code" class='form-control category_name' placeholder="Category Code"/>
                 </div>         
              </div> 
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Link</label>
                  <div class="col-sm-8">                  
                    <input type='checkbox'  class="flat-red" ng-model='show_system'/>
                 </div>         
              </div>
              <div class="form-group" ng-show='show_system'>
                <label for="inputEmail3"  class="col-sm-4 control-label">System Category</label>

                <div class="col-sm-8">                  
                  <select class="form-control select2 sys_category_id" ng-model='category.sys_category_id' >
                    @foreach($sys_category as $cat)
                    <option value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                    @endforeach
                  </select>
               
                </div>                 
              </div>      
                          
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="reset" class="btn btn-default">Cancel</button>
              <button type="button" ng-click="saveCategory(category)" class="btn btn-info pull-right">Add</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
      <div class='col-md-7'>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">List</h3>
          </div>
          <a href="#" ng-click="getCategories()" class="hide refresh"></a>
          
            <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>                
                <th>Category Name</th>
                <th>Category Code</th>
                <th>No. Of Suppliers</th>
                <th style="width: 40px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="cat in categories |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>
                  <td ng-bind="cat.category_name"></td>
                  <td ng-bind="cat.category_code"></td>
                  <td ng-bind='cat.count_supplier'></td>
                  <td>
                    <a href="#"class='category-edit' data-id="@{{cat.category_id}}"><i class="fa fa-pencil"></i></a>
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
<script src="/angular/controllers/category.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.category").addClass('active');
  });
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });  
  $(document).on('click','.category-edit',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $.get( "category/"+id+"/edit", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Edit Category',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  var $this   = $(this);
                  var data = $('#form-category').serialize();  
                  $.ajax({
                    url: "/category/"+id,
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
