@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><i class="fa fa-circle"></i> Products</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="productCtrl">
      <div class='col-md-12'>
        <div class="box">
            <!-- /.box-header -->

          <div class="box-body" >
            <div class='row'>
              <div class='col-md-5 pull-right'>
                <div class='col-md-8'>
                  <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter" ng-keyup="filterRecord(filterBy)"/>
                </div>
                <a href="/products-regular/create" class='btn  btn-info'>New Product  <span class="glyphicon glyphicon-plus-sign"></span></a>
              </div>
            </div>
            <br>
            <table id="products-regular" class="bsTable table table-striped"
             data-url="/products-regular-list"
             data-pagination="true"
             data-side-pagination="server"
             data-page-list="[10,20,50]"
             data-sort-order="desc"
             js-bootstraptable>
            <thead>
                <tr>
                    <th class="col-md-5" data-sortable="true" data-field="product_name" >Product Name</th>
                    <th class="col-md-4"data-sortable="true" data-field="category_name" >Category Name</th>
                    <th class="col-md-3" data-sortable="true" data-field="cost_price" >Price</th>
                    <th style='width:50px' data-field="action" class="action">Action</th>
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
<script src="/angular/controllers/product.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/productService.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $("li.record-management").addClass('active');
    $("li.product").addClass("active");
    $("li.products-regular").addClass("active");
  })
  $(function(){
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  })
  $(document).on('click','.product-edit',function(e){
    e.preventDefault();
    id = $(this).data('id');
    $.get( "products-regular/"+id+"/edit", function( data ) {
      var dialog = bootbox.dialog({
          title: 'Edit Product',
          message: data,
          buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success',
                callback:function(){
                  var $this   = $(this);
                  var data = $('#form-product').serialize();
                  $.ajax({
                    url: "/products-regular/"+id,
                    method:'PUT',
                    data: data,
                    dataType: 'JSON',
                    success: function(result){
                      if (result['status'] == true) {
                        bootbox.hideAll();
                        message(result);
                          $('.bsTable').bootstrapTable('refresh');

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
