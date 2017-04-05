@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/category"><i class="fa fa-circle"></i> Category</a></li>
        <li class="active"><i class="fa fa-circle"></i> Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="categoryCtrl as cc">
      <div class='col-md-8 col-md-offset-2 warn-on-exit '>
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
            <div class="box-footer text-center">
              <button type="reset" class="btn btn-danger">Cancel</button>
              <button type="button" ng-click="cc.saveCategory(category)" class="btn btn-success ">Add <span class="glyphicon glyphicon-floppy-disk"></span></button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>

  </section>
  <!-- /.row (main row) -->
  @stop
  @section('html_footer')
  @parent
  <script src="/angular/controllers/category.js"></script>
  <script src="/angular/service/HttpRequestFactory.js"></script>
  <script src="/angular/service/categoryService.js"></script>
  <script type="text/javascript">
  $(document).ready(function(){
  $("li.settings").addClass('active');
  $("li.settings-product").addClass('active');
  $("li.category").addClass('active');
  });

  </script>
  @stop
