@extends('layouts.master')

@section('content')
  <link rel="stylesheet" href="/plugins/iCheck/all.css">
  <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">  
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i>Home</a></li>
        <li class="active"><i class="fa fa-circle"></i>Branches</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="branchCtrl as bc">
      <div class='col-md-12'>
        <div class="box">
          <div class="box-body">
            <div class='row'>
              <div class='col-md-5 pull-right'>
                <div class='col-md-8'>
                  <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter" ng-keyup="bc.filterRecord(filterBy)"/>
                </div>
                <a href="/branches/create" class='btn  btn-info'>New Branch  <span class="glyphicon glyphicon-plus-sign"></span></a>
              </div>
            </div>
            <br>
            <table id="branches" class="bsTable table table-striped"
             data-url="/branches/ng-branch-list"
             data-pagination="true"
             data-side-pagination="server"
             data-page-list="[10,20,50]"
             data-sort-order="desc"
             data-show-clear="true"
             js-bootstraptable>
            <thead>
                <tr>
                    <th style='width:50px' data-field="action" class="action">Action</th>
                    <th class="col-md-5" data-field="branch_name" >Branch Name</th>
                    <th class="col-md-4"data-field="cluster_name" >Cluster</th>
                    <th class="col-md-1"  data-field="status" >Status</th>
                    <th class="col-md-1"  data-field="lock" >Lock</th>
                    <th class="col-md-1"  data-field="suspended" >Suspended</th>
                </tr>
            </thead>
            </table>
          </div>
            <!-- /.box-body -->

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
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.settings").addClass('active');
    $("li.branches").addClass('active');
  });
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
  $(document).on('click','.branch-edit',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $.get( "branches/"+id+"/edit", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Edit Branch',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  var $this   = $(this);
                  var data = $('#form-branches').serialize();
                  $.ajax({
                    url: "/branches/"+id,
                    method:'PUT',
                    data: data,
                    dataType: 'JSON',
                    success: function(result){
                      if (result['status'] == true) {
                        bootbox.hideAll();
                        message(result);
                        $(".refresh").trigger('click');
                      } else {
                        message(result);
                        return false;
                      }
                    },

                  });

                  return false;
                }
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
      });

    });
  })
</script>
@stop
