@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <section class="content-header">
      <h1>
        Products     
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Products</li>
        <li class="active"><i class="fa fa-circle"></i> Regular</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="productCtrl">
      <div class='col-md-5'>
        @include('products.create')
      </div>
      <div class='col-md-7'>
        <div class="box">
          <div class="box-header with-border">
            @include('layouts.search')
          </div>
          <a href="#" ng-click="getProducts()" class="hide refresh"></a>
            <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>  
                <th>Products</th>              
                <th>Category </th>
                <th>Price</th>
                <th style="width: 60px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="prod in products |filter:searchQry| myFilter:product.category_id|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>
                  <td ng-bind="prod.product_name"></td>
                  <td ng-bind="prod.category.category_name"></td>
                  <td ng-bind="prod.retail_price"></td>
                  <td>
                     
                    <a href="#" class="product-edit" data-id="@{{prod.product_id}}"><i class="fa fa-pencil"></i></a>
                    <a href="#"><i class="fa fa-trash warning"></i></a>
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
<script src="/angular/controllers/product.js"></script>
<script src="/angular/dirPagination.js"></script>
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
