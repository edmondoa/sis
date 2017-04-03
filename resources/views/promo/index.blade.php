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
            <a href="#" ng-click="reload()" class='hide reload'></a>
          <div class="box-body" >
              <div class='row'>
                <div class='col-md-5 pull-right'>
                  <div class='col-md-8'>
                    <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter" ng-keyup="filterRecord(filterBy)"/>
                  </div>
                  <a href="/products-promo/create" class='btn  btn-info'>New Promo  <span class="glyphicon glyphicon-plus-sign"></span></a>
                </div>
                <div class='col-md-4'>
                  <select class='form-control' ng-model="filterBy.status" ng-change="filterRecord(filterBy)">
                    <option value="">All</option>
                    <option value="active">Active</option>
                    <option value="incoming">Incoming</option>
                    <option value="inactive">In-active</option>
                  </select>
                </div>
              </div>
              <br>
              <table id="products-promo" class="bsTable table table-striped"
               data-url="/products-promo/ng-promo-list"
               data-pagination="true"
               data-side-pagination="server"
               data-page-list="[10,20,50]"
               data-sort-order="desc"
               data-show-clear="true"
               js-bootstraptable>
              <thead>
                  <tr>
                      <th style='width:50px' data-field="action" class="action">Action</th>
                      <th class="col-md-5" data-sortable="true" data-field="promo_id" >Promo ID</th>
                      <th class="col-md-4"data-sortable="true" data-field="category_name" >Category Name</th>
                      <th class="col-md-3" data-sortable="true" data-field="start_date" >Start Date</th>
                      <th class="col-md-3" data-sortable="true" data-field="end_date" >End Date</th>
                      <th class="col-md-3" data-sortable="true" data-field="promo_price" >Price</th>
                      <th class="col-md-3" data-sortable="true" data-field="promo_discount" >Discount</th>
                  </tr>
              </thead>
              </table>
            </div>
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
