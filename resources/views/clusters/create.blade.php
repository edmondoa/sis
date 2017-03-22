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
    <section class="content" ng-controller="clusterCtrl as cc">
      <div class='col-md-8 col-md-offset-2 warn-on-exit '>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">New Cluster</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-2 control-label">Cluster Name</label>

                <div class="col-sm-10">
                  <input type='text' ng-model="cluster.cluster_name" class='form-control' placeholder="Cluster Name"/>
               </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-2 control-label">Notes</label>

                <div class="col-sm-10">
                  <textarea ng-model='cluster.notes' class='form-control'></textarea>
               </div>
              </div>
            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <button type="reset" class="btn btn-warning">Cancel</button>
              <button type="button" ng-click="cc.saveCluster(cluster)" class="btn btn-success ">Save<span class="glyphicon glyphicon-floppy-disk"></span></button>
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
<script src="/angular/controllers/cluster.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/clusterService.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.setting-branches").addClass('active');
    $("li.clusters").addClass('active');
  });

</script>
@stop
