@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <section class="content-header">
      <h1></h1>

      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/product-storage"><i class="fa fa-circle"></i> Product Storage</a></li>
        <li class="active"><i class="fa fa-circle"></i> Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="pStorageCtrl as ps">
      <div class='col-md-8 col-md-offset-2 warn-on-exit'>

        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">New Product Storage</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Branch</label>

                  <div class="col-sm-9">
                    <select class='form-control' ng-model='pr.branch_id' >
                      @foreach($branches as $branch)
                      <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group ">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  ng-model='pr.storage_name' placeholder="Storage Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

                  <div class="col-sm-9">
                    <textarea class="form-control" id="" ng-model='pr.notes'></textarea>

                  </div>
                </div>

              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <button type="reset" class="btn btn-danger">Cancel</button>
              <button type="button" ng-click="ps.saveStorage(pr)" class="btn btn-success ">Add <span class="glyphicon glyphicon-floppy-disk"></span></button>
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
<script src="/angular/controllers/storage.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/storageService.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.settings-product").addClass("active");
    $("li.product-storage").addClass("active");
  })
  $(function(){
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  })

</script>
@stop
