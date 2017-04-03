@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-circle"></i> Clusters</li>
        <li><a href="/clusters/create"><i class="fa fa-circle"></i> Create</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="clusterCtrl as cc">
      <div class='col-md-12'>
        <div class="box">
            <!-- /.box-header -->
          <div class="box-body">
          <div class='row'>
            <div class='col-md-5 pull-right'>
              <div class='col-md-8'>
                <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter" ng-keyup="cc.filterRecord(filterBy)"/>
              </div>
              <a href="/clusters/create" class='btn  btn-info'>New Cluster  <span class="glyphicon glyphicon-plus-sign"></span></a>
            </div>
          </div>
          <br>
          <table id="cluster" class="bsTable table table-striped"
           data-url="/clusters/ng-cluster-list"
           data-pagination="true"
           data-side-pagination="server"
           data-page-list="[10,20,50]"
           data-sort-order="desc"
           data-show-clear="true"
           js-bootstraptable>
          <thead>
              <tr>
                  <th style='width:50px' data-field="action" class="action">Action</th>
                  <th class="col-md-8" data-sortable="true" data-field="cluster_name" >Cluster Name</th>
                  <th class="col-md-4"data-sortable="true" data-field="count_branch" >No. Of Branches</th>
              </tr>
          </thead>
          </table>
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
    $("li.clusters").addClass('active');
  });
  $(document).on('click','.cluster-edit',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $.get( "clusters/"+id+"/edit", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Edit Cluster',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  var $this   = $(this);
                  var data = $('#form-cluster').serialize();
                  $.ajax({
                    url: "/clusters/"+id,
                    method:'PUT',
                    data: data,
                    dataType: 'JSON',
                    success: function(result){
                      if (result['status'] == true) {
                        bootbox.hideAll();
                        message(result);
                        $(".bsTable").bootstrapTable('refresh');
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

//Delete
$(document).on('click','.cluster-delete',function(e){
    e.preventDefault();
    id = $(this).data('id');
    bootbox.confirm({
    title: "Remove Cluster?",
    message: "Do you want to remove this cluster now? This cannot be undone.",
    buttons: {
        cancel: {
            label: '<i class="fa fa-times"></i> Cancel'
        },
        confirm: {
            label: '<i class="fa fa-check"></i> Confirm'
        }
    },
    callback: function (result) {
        if(result)
        {
          $.ajax({
            url: "/clusters/"+id,
            method:'DELETE',
            dataType: 'JSON',
            success: function(result){
              if (result['status'] == true) {
                bootbox.hideAll();
                message(result);
                $(".bsTable").bootstrapTable('refresh');
              } else {
                message(result);
                return false;
              }
            },

          });
        }
    }
});
  })
</script>
@stop
