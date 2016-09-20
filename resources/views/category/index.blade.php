@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Categories     
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Settings</li>
        <li class="active"><i class="fa fa-circle"></i> Category</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="categoryCtrl">
      <div class='col-md-5'>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Add Category</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-2 control-label">Name</label>

                <div class="col-sm-10">                  
                  <select class="form-control select2 category_name"ng-model='category.sys_category_id' >
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
            <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>                
                <th>Category Name</th>
                <th>Suppliers</th>
                <th style="width: 40px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="cat in categories |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>
                  <td ng-bind="cat.category_name"></td>
                  <td ></td>
                  <td>
                    <a href="#"><i class="fa fa-pencil"></i></a>
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
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>
@stop
