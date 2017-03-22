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
          <a href="#" ng-click="cc.callServer" class="hide refresh"></a>
            <!-- /.box-header -->
          <div class="box-body">
            <!-- <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>
                <th>Cluster Name</th>
                <th>No. Of Branches</th>
                <th style="width: 40px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="cluster in clusters |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>
                  <td ng-bind="cluster.cluster_name"></td>
                  <td ng-bind="cluster.count_branch"></td>
                  <td>
                    <a href="#" class='cluster-edit' data-id="@{{cluster.cluster_id}}" ><i class="fa fa-pencil"></i></a>
                    <a href="#" ng-hide="cluster.count_branch > 0"><i class="fa fa-trash text-red cluster-delete" data-id="@{{cluster.cluster_id}}"></i></a>
                  </td>
                </tr>
              </tbody>

            </table>
          </div>

          <div class="box-footer clearfix">
            <dir-pagination-controls boundary-links="true" template-url="../angular/dirPagination.tpl.html"></dir-pagination-controls>
          </div> -->
          <table class="table table-striped"  st-pipe="cc.callServer" st-table="cc.clusters">
        		<thead>
        		<tr>
        			<th style="width: 10px">#</th>
        			<th st-sort="cluster_name">Cluster Name</th>
        			<th st-sort="count_branch">No. Of Branches</th>
        			<th >Action</th>
        		</tr>
            <tr>
              <td colspan="4">
                <input st-search="" placeholder="Search here.." class="input-sm form-control" type="search">
              </td>
            </tr>
        		</thead>
        		<tbody  ng-show="!cc.isLoading">
        		<tr ng-repeat="cluster in cc.clusters">
              <td ng-bind="$index + 1"></td>
              <td ng-bind="cluster.cluster_name"></td>
              <td ng-bind="cluster.count_branch"></td>
              <td>
                <a href="#" class='cluster-edit' data-id="@{{cluster.cluster_id}}" ><i class="fa fa-pencil"></i></a>
                <a href="#" ng-hide="cluster.count_branch > 0"><i class="fa fa-trash text-red cluster-delete" data-id="@{{cluster.cluster_id}}"></i></a>
              </td>
        		</tr>
        		</tbody>
            <tbody ng-show="mc.isLoading">
            	<tr>
            		<td colspan="4" class="text-center">Loading ... </td>
            	</tr>
          	</tbody>
        		<tfoot>
        			<tr>

        					<td class="text-center" st-pagination="" st-items-by-page="10" colspan="4">

        			</tr>
        		</tfoot>
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
                $(".refresh").trigger('click');
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
