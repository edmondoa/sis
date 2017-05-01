@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/clusters"><i class="fa fa-circle"></i> Clusters</a></li>
        <li class="active"><i class="fa fa-circle"></i> Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="branchCtrl as bc">
      <div class='col-md-8 col-md-offset-2 warn-on-exit '>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">New Branch</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal" name='branch-form'>
            <div class="box-body">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Branch Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  ng-model='branch.branch_name'  name='branch_name' placeholder="Branch Name">
                  </div>
                </div>
                <div class="form-group ">
                  <label for="inputEmail3" class="col-sm-3 control-label">Business Name</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  ng-model='branch.business_name'  name='business_name' placeholder="Business Name">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Cluster</label>
                  <div class="col-sm-9">
                    <select class="form-control select2 cluster_name" ng-model='branch.cluster_id'  name='cluster_id'>
                      @foreach($clusters as $cluster)
                      <option value="{{$cluster->cluster_id}}">{{$cluster->cluster_name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Addressline1</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" ng-model='branch.addressline1'  name='addressline1'></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Addressline2</label>
                  <div class="col-sm-9">
                    <textarea class="form-control"  ng-model='branch.addressline2'  name='addressline2'></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">TIN #</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  ng-model='branch.tin_no'  name='tin_no' placeholder="TIN #">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">BIR Permit #</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  ng-model='branch.bir_permit_no'  name='bir_permit_no' placeholder="BIR Permit #">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Lock</label>
                  <div class="col-sm-9">
                   <label>
                      <input type="checkbox" class="flat-red" id='lock'  name='lock' checked>
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Suspended</label>
                  <div class="col-sm-9">
                    <label>
                      <input type="checkbox" class="flat-red" id='suspended' name='suspended' >
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>
                  <div class="col-sm-9">
                    <textarea class="form-control"  ng-model='branch.notes' name='notes'></textarea>
                  </div>
                </div>
                <!-- <div class="form-group">
                  <label for="inputEmail3"  class="col-sm-3 control-label">Credit Limit </label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control"  ng-model='branch.default_credit_limit' placeholder="100.00">
                  </div>
                </div> -->

              </div>


            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <button type="reset" class="btn btn-warning">Cancel</button>
              <button type="button" ng-click="bc.saveBranch(branch)" class="btn btn-success">Add <span class="glyphicon glyphicon-floppy-disk"></span></button>
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
<script src="/angular/controllers/branch.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/branchService.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $("li.settings").addClass('active');
  $("li.setting-branches").addClass('active');
  $("li.branches").addClass('active');
});

</script>
@stop
