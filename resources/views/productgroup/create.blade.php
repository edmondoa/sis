@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/product-group"><i class="fa fa-circle"></i> Groups</a></li>
        <li class="active"><i class="fa fa-circle"></i> Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="pGroupCtrl as pg">
      <div class='col-md-8 col-md-offset-2 warn-on-exit '>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">New Product Group</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="col-md-12">
                <div class="form-group ">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  ng-model='group.group_name' placeholder="Group Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="" ng-model='group.notes'></textarea>

                  </div>
                </div>

              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <button type="reset" class="btn btn-danger">Cancel</button>
              <button type="button" ng-click="pg.saveGroup(group)" class="btn btn-success ">Add <span class="glyphicon glyphicon-floppy-disk"></span></button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>

    </section>
      <!-- /.row (main row) -->
    @stop
    @section('html_footer')
    @parent
    <script src="/angular/controllers/group.js"></script>
    <script src="/angular/service/HttpRequestFactory.js"></script>
    <script src="/angular/service/groupService.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.setting-products").addClass('active');
    $("li.product-group").addClass('active');
    });

    </script>
    @stop
