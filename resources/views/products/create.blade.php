<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Add Product</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal">
    <div class="box-body">
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Category</label>

        <div class="col-sm-9">
          <select class='form-control' ng-model='product.category_id' >            
            @foreach($category as $cat)
            <option value="{{$cat->category_id}}">{{$cat->category_name}}</option>
            @endforeach
          </select>
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Code</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="productcode" ng-model='product.productcode' placeholder="Product Code">
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Bar Code</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.bar_code' placeholder="Bar Code">
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Model #</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.model_no' placeholder="Model">
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Product</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.productname' placeholder="Product Name">
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Price</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.current_retail_price' placeholder="100.00">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Last Price</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.last_cost_price' placeholder="100.00">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Discount</label>

        <div class="col-sm-9">
          <select class='form-control' ng-model='product.discount_id' >            
            @foreach($category as $cat)
            <option value="{{$cat->category_id}}">{{$cat->category_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Book</label>

        <div class="col-sm-9">          
          <label>
            <input type="radio" name="non_book" ng-model='product.non_book' class="flat-red" checked>
          </label>
          <label>
            <input type="radio" name="non_book" ng-model='product.non_book' class="flat-red">
          </label>            
              
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Price</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.current_retail_price' placeholder="100.00">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Price</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.current_retail_price' placeholder="100.00">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Price</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.current_retail_price' placeholder="100.00">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Price</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.current_retail_price' placeholder="100.00">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Price</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.current_retail_price' placeholder="100.00">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Price</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.current_retail_price' placeholder="100.00">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Price</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.current_retail_price' placeholder="100.00">
        </div>
      </div>                    
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="reset" class="btn btn-default">Cancel</button>
      <button type="button" ng-click="saveProduct(product)" class="btn btn-info pull-right">Add</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>