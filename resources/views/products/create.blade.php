@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <section class="content-header">
      <h1></h1>

      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="/products-regular"><i class="fa fa-circle"></i> Products</a></li>
        <li class="active"><i class="fa fa-circle"></i> Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="productCtrl">
      <div class='col-md-8 col-md-offset-2 warn-on-exit'>
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">Add Product</h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <form class="form-horizontal " id='promoForm'>
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Category</label>

                <div class="col-sm-8">
                  <select class='form-control' ng-model='product.category_id' >
                    @foreach($category as $cat)
                    <option value="{{$cat->category_id}}">{{$cat->category_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Product Code</label>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="product_code" ng-model='product.product_code' placeholder="Product Code">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Product Name</label>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="" ng-model='product.product_name' placeholder="Product Name">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Retail Price</label>

                <div class="col-sm-8">
                  <div class="input-group">
                    <span class="input-group-addon">&#8369;</span>
                    <input type="text" class="form-control" id="" ng-model='product.retail_price' placeholder="0.00">

                  </div>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Cost Price</label>

                <div class="col-sm-8">
                 <div class="input-group">
                    <span class="input-group-addon">&#8369;</span>
                    <input type="text" class="form-control" id="" ng-model='product.cost_price' placeholder="0.00">

                  </div>

                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Bar Code</label>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="" ng-model='product.barcode' placeholder="Bar Code">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Model #</label>

                <div class="col-sm-8">
                  <input type="text" class="form-control" id="" ng-model='product.model_no' placeholder="Model">
                </div>
              </div>


              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Discount</label>

                <div class="col-sm-8">
                  <select class='form-control' ng-model='product.discount_id' >
                    @foreach($discount as $dis)
                    <option value="{{$dis->discount_id}}">{{$dis->account_level->level_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
               <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Group</label>

                <div class="col-sm-8">
                  <select class='form-control' ng-model='product.group_id' >
                    @foreach($groups as $group)
                    <option value="{{$group->group_id}}">{{$group->group_name}}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Non Book</label>

                <div class="col-sm-8">
                  <label>
                    <input type="checkbox" class="flat-red" id='non-book'ng-model='product.non_book' >
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Non Consign</label>

                <div class="col-sm-8">
                  <label>
                    <input type="checkbox" class="flat-red" id='non_consign'ng-model='product.non_consign' >
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Non Returnable</label>

                <div class="col-sm-8">
                  <label>
                    <input type="checkbox" class="flat-red" id='non_returnable'ng-model='product.non_returnable' >
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Vatable</label>

                <div class="col-sm-8">
                  <label>
                    <input type="checkbox" class="flat-red" id='vatable' checked>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Tie up</label>

                <div class="col-sm-8">
                  <label>
                    <input type="checkbox" class="flat-red" id='tieup'ng-model='product.tieup' >
                  </label>
               </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Lock</label>

                <div class="col-sm-8">
                  <label>
                    <input type="checkbox" class="flat-red" id='lock' checked>
                  </label>
                </div>
              </div>

              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Suspended</label>

                <div class="col-sm-8">
                  <label>
                    <input type="checkbox" class="flat-red" id='suspended'ng-model='product.suspended' >
                  </label>
               </div>
              </div>

              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-4 control-label">Notes</label>

                <div class="col-sm-8">
                 <textarea ng-model='product.notes' class='form-control'></textarea>
                </div>
              </div>

            </div>
            <!-- /.box-body -->
            <div class="box-footer text-center">
              <button type="reset" class="btn btn-warning">Cancel</button>
              <button type="button" ng-click="saveProduct(product)" class="btn btn-success">Add <span class="glyphicon glyphicon-floppy-disk"></span></button>
            </div>
            <!-- /.box-footer -->
          </form>
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
