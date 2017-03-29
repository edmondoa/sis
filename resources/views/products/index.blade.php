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
            <div tasty-table bind-resource-callback="callServer" bind-init="init" bind-filters="filterBy">

              <div class='col-md-5 pull-right'>
                <div class='col-md-8'>
                  <input type='text'class='form-control' ng-model="filterBy.searchStr" placeholder="Filter"/>
                </div>
                <a href="/products-regular/create" class='btn  btn-info'>New Product  <span class="glyphicon glyphicon-plus-sign"></span></a>
              </div>
              <table class="table table-striped">
                <thead tasty-thead></thead>
                <tbody>
                  <tr ng-repeat="product in rows">
                    <td ng-bind="product.product_name"></td>
                    <td ng-bind="product.category.category_name"></td>
                    <td ng-bind="product.cost_price"></td>
                    <td>
                      <a href="#" class='product-edit' data-id="@{{product.product_id}}" ><i class="fa fa-pencil"></i></a>
                      <a href="#"><i class="fa fa-trash text-red product-delete" data-id="@{{product.product_id}}"></i></a>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div tasty-pagination></div>
            </div>
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
