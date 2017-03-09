@extends('layouts.master')

@section('content')
  <link rel="stylesheet" href="/plugins/iCheck/all.css">
  <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Approvals
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Operations</li>
        <li class="active"><i class="fa fa-circle"></i> Approvals</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="approvalCtrl">
      <div class='col-md-12'>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">List</h3>
          </div>
          <a href="#" ng-click="getApproves()" class="hide refresh"></a>

            <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>
                <th class="col-sm-2">Date</th>
                <th class="col-sm-3">Branch Name</th>
                <th class="col-sm-2">Type</th>
                <th class="col-sm-2">Name</th>
                <th class="col-sm-1">Status</th>
                <th style="width: 40px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="app in approvals |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>
                  <td ng-bind="app.post_date"></td>
                  <td ng-bind="app.branch_name"></td>
                  <td><span ng-bind="app.approval_type"></span></td>
                   <td><span ng-bind="app.user"></span></td>
                  <td><span class="text-info" ng-bind="app.status"></span></td>


                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Action</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu">
                        <li ng-show="app.approval_type == 'STOCK TRANSFER'"><a href="#" ng-click="recieve(app)">Recieve<i class='pull-right glyphicon glyphicon-thumbs-up'></i> </a></li>
                        <li ng-show="app.approval_type != 'STOCK TRANSFER'"><a href="#" ng-click="approved(app)">Approve<i class='pull-right glyphicon glyphicon-thumbs-up'></i> </a></li>
                        <li><a href="#" ng-click="dis_approved(app)">Decline<i class='pull-right glyphicon glyphicon-thumbs-down'></i> </a></li>
                        <li><a href="#" class='show-stock' data-type="@{{app.approval_type}}"data-id="@{{app.approvalable_id}}">Show <i class="pull-right glyphicon glyphicon-eye-open"/></i></a></li>
                      </ul>
                    </div>
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
<script src="/angular/controllers/approvals.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.operations").addClass('active');
    $("li.approvals").addClass("active");
  })
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
  $(document).on('click','.show-stock',function(e){
    e.preventDefault();
    type = $(this).data('type').replace(" ","_");
    id = $(this).data('id');
    $.get( type.toLowerCase()+"/"+id, function( data ) {
      var dialog = bootbox.dialog({
          title: type+' Details',
          size: 'large',
          message: data,
          buttons: {
            confirm: {
                label: '<i class="fa fa-download "></i> Generate PDF',
                className: 'btn btn-primary pull-right',
                callback:function(){
                  $("iframe").attr('src',type.toLowerCase()+"/pdf/"+id);
                  return false;
                }
            },
            cancel: {
                label: 'Close',
                className: 'btn-danger'
            }
        },
      });

    });
  })

</script>
@stop
