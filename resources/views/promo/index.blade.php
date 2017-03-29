@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-circle"></i> Promo</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="promoCtrl as pc">
      <div class='col-md-12'>
        <div class="box">
            <!-- /.box-header -->
          <div class="box-body" >
            <div tasty-table bind-resource-callback="callServer" bind-init="init" bind-filters="filterBy">
              <div class='col-md-5'>
                <div class='col-md-8'>
                  <select class='form-control' ng-model="filterBy.status">
                    <option value="">All</option>
                    <option value="active">Active</option>
                    <option value="incoming">Incoming</option>
                    <option value="inactive">In-active</option>
                  </select>

                </div>
              </div>

              <div class='col-md-5 pull-right'>
                <div class='col-md-8'>
                  <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter"/>
                </div>
                <a href="/products-promo/create" class='btn  btn-info'>New Promo  <span class="glyphicon glyphicon-plus-sign"></span></a>
              </div>
              <table class="table table-striped">
                <thead tasty-thead></thead>
                <tbody>
                  <tr ng-repeat="promo in rows">
                    <td ng-bind="promo.promo_id"></td>
                    <td ng-bind="promo.product.category.category_name"></td>
                    <td ng-bind="promo.product.product_name"></td>
                    <td ng-bind="promo.start_date"></td>
                    <td ng-bind="promo.end_date"></td>
                    <td ng-bind="promo.promo_price"></td>
                    <td ng-bind="promo.promo_discount"></td>
                    <td>
                      <a href="#" class='promo-edit' data-id="@{{promo.promo_id}}" ><i class="fa fa-pencil"></i></a>
                      <a href="#"><i class="fa fa-trash text-red promo-delete" data-id="@{{promo.promo_id}}"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div tasty-pagination></div>
            </div>
<!--
          <table class="table table-striped "  ng-init="callServer()" >
        		<thead>
        		<tr>
        			<th style="width: 10px">#</th>
        			<th >Promo</th>
              <th >CAT</th>
        			<th >Product</th>
              <th >Start Date</th>
              <th >End Date</th>
              <th >Price</th>
              <th >Discount</th>
        			<th >Action</th>
        		</tr>
            <tr>
              <td colspan="4">
                <input  placeholder="Search here.." class="input-sm form-control" type="search">
              </td>
            </tr>
        		</thead>
        		<tbody  ng-show="!pc.isLoading">
        		<tr dir-paginate="promo in promos |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
              <td ng-bind="$index + 1"></td>
              <td ng-bind="promo.promo_id"></td>
              <td ng-bind="promo.product.category.category_name"></td>
              <td ng-bind="promo.product.product_name"></td>
              <td ng-bind="promo.start_date"></td>
              <td ng-bind="promo.end_date"></td>
              <td ng-bind="promo.promo_price"></td>
              <td ng-bind="promo.promo_discount"></td>
              <td>
                <a href="#" class='cluster-edit' data-id="@{{promo.promo_id}}" ><i class="fa fa-pencil"></i></a>
                <a href="#" ng-hide="cluster.count_branch > 0"><i class="fa fa-trash text-red cluster-delete" data-id="@{{cluster.cluster_id}}"></i></a>
              </td>
        		</tr>
        		</tbody>
            <tbody ng-show="pc.isLoading">
            	<tr>
            		<td colspan="4" class="text-center">Loading ... </td>
            	</tr>
          	</tbody>
        	</table>
          <div class="box-footer clearfix">
            <dir-pagination-controls boundary-links="true" template-url="../angular/dirPagination.tpl.html"></dir-pagination-controls>
          </div>
        -->
        </div>
      </div>
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent

<script src="/angular/controllers/promo.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/promoService.js"></script>
<script src="/angular/dirPagination.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.record-management").addClass('active');
    $("li.product").addClass('active');
    $("li.promo").addClass('active');
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
