@extends('layouts.master')

@section('content')
    <section class="content-header">
      <h1>
        Account Level     
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Settings</li>
        <li class="active"><i class="fa fa-circle"></i> Account Level</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="accLevelCtrl">
      <div class='col-md-5'>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Add Account Level</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-3 control-label">Level Name</label>

                <div class="col-sm-9">                  
                  <input type='text' ng-model='acc_level.level_name' class='form-control'/>               
                </div>                 
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-3 control-label">Credit Days</label>

                <div class="col-sm-9">                  
                  <input type='text' ng-model='acc_level.credit_days' class='form-control'/>               
                </div>                 
              </div>                  
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
              <button type="reset" class="btn btn-default">Cancel</button>
              <button type="button" ng-click="saveAccountLevel(acc_level)" class="btn btn-info pull-right">Add</button>
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
                <th>Level Name</th>              
                <th>Credit Days </th>              
                <th style="width: 40px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="acc in acc_levels |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>                 
                  <td ng-bind="acc.level_name"></td>
                  <td ng-bind="acc.credit_days"></td>
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
<script src="/angular/controllers/account_level.js"></script>
<script src="/angular/dirPagination.js"></script>

@stop
