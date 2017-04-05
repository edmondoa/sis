@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <section class="content-header">
      <h1></h1>

      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/suppliers"><i class="fa fa-circle"></i> Supplier</a></li>
        <li class="active"><i class="fa fa-circle"></i> Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="supplierCtrl as sc">
      <div class='col-md-8 col-md-offset-2 warn-on-exit'>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">New Supplier</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="col-md-12">
                <div class="form-group ">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Supplier Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  ng-model='supplier.supplier_name' placeholder="Supplier Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Contact Person</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control"  ng-model='supplier.contact_person' placeholder="Contact Person">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Mobile # 1</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="" ng-model='supplier.mobile1_no' placeholder="Mobile # 1">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Mobile # 2</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="" ng-model='supplier.mobile2_no' placeholder="Mobile # 1">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Landline #</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="" ng-model='supplier.landline_no' placeholder="Landline #">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Email</label>

                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="" ng-model='supplier.email' placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Lock</label>
                  <div class="col-sm-9">
                   <label>
                      <input type="checkbox" class="flat-red" id='lock' checked>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Suspended</label>
                  <div class="col-sm-9">
                    <label>
                      <input type="checkbox" class="flat-red" id='suspended' >
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="" ng-model='supplier.notes'></textarea>

                  </div>
                </div>

              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <button type="reset" class="btn btn-danger">Cancel</button>
              <button type="button" ng-click="sc.saveSupplier(supplier)" class="btn btn-success ">Add <span class="glyphicon glyphicon-floppy-disk"></span></button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
    </section>
    @stop
    @section('html_footer')
    @parent
    <script src="/angular/controllers/supplier.js"></script>
    <script src="/angular/service/HttpRequestFactory.js"></script>
    <script src="/angular/service/supplierService.js"></script>
    <script src="/plugins/iCheck/icheck.min.js"></script>
    < <script type="text/javascript">
      $(document).ready(function(){
        $("li.settings").addClass('active');
        $("li.settings-product").addClass('active');
        $("li.suppliers").addClass('active');
      })
    </script>
    @stop
