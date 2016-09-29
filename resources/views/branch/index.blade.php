@extends('layouts.master')

@section('content')
  <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Branches  {{Session::get('dbname')}}   
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Settings</li>
        <li class="active"><i class="fa fa-circle"></i> Branches</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="branchCtrl">
      <div class='col-md-12'>
        @include('branch.create')
      </div>
      <div class='col-md-12'>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">List</h3>
          </div>
            <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>                
                <th>Branch Name</th>
                <th>Business Name</th>
                <th>Cluster</th>
                <th>Terminal Type</th>
                <th>Status</th>
                <th style="width: 40px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="br in branches |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>
                  <td ng-bind="br.branch_name"></td>
                  <td ng-bind="br.business_name"></td>
                  <td ng-bind="br.cluster.cluster_name"></td>
                  <td ng-bind="br.terminal_type"></td>
                  <td ng-bind="br.status"></td>
                  <td>
                    <a href="#"><i class="fa fa-pencil"></i></a>                   
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
<script src="/angular/controllers/branch.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>
@stop
