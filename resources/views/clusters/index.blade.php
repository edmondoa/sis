@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Clusters     
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Settings</li>
        <li class="active"><i class="fa fa-circle"></i> Clusters</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="clusterCtrl">
      <div class='col-md-5'>
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
            <div class="box-footer">
              <button type="reset" class="btn btn-default">Cancel</button>
              <button type="button" ng-click="saveCluster(cluster)" class="btn btn-info pull-right">Add</button>
            </div>
            <!-- /.box-footer -->
          </form>
        </div>
      </div>
      <div class='col-md-7'>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">List</h3>
          </div>
          <a href="#" ng-click="getClusters()" class="hide refresh"></a>
            <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>                
                <th>Cluster Name</th>
                <th>No. of Branch</th>
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
<script src="/angular/controllers/cluster.js"></script>
<script src="/angular/dirPagination.js"></script>
<script type="text/javascript">
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
