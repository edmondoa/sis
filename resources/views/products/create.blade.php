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
          <div class="input-group">
            <span class="input-group-addon">&#8369;</span>
            <input type="text" class="form-control" id="" ng-model='product.current_retail_price' placeholder="100.00">
            <span class="input-group-addon">.00</span>
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Last Price</label>

        <div class="col-sm-9">
         <div class="input-group">
            <span class="input-group-addon">&#8369;</span>
            <input type="text" class="form-control" id="" ng-model='product.last_cost_price' placeholder="100.00">
            <span class="input-group-addon">.00</span>
          </div>
          
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Discount</label>

        <div class="col-sm-9">
          <select class='form-control' ng-model='product.discount_id' >            
            @foreach($discount as $dis)
            <option value="{{$dis->discount_id}}">{{$dis->account_level->level_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Book</label>

        <div class="col-sm-9">          
          <label>
            <input type="radio" name="non_book" ng-model='product.non_book' value="1" class="flat-red" checked>
            <span>true</span>
          </label>
          <label>
            <input type="radio" name="non_book" ng-model='product.non_book' value="0"class="flat-red">
            <span>false</span>   
          </label>            
              
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Consign</label>

        <div class="col-sm-9">          
          <label>
            <input type="radio" name="non_consign" ng-model='product.non_consign' value="1" class="flat-red" checked>
            <span>true</span>
          </label>
          <label>
            <input type="radio" name="non_consign" ng-model='product.non_consign' value='0'class="flat-red">
            <span>false</span></label>  

              
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Returnable</label>

        <div class="col-sm-9">          
          <label>
            <input type="radio" name="non_returnable" ng-model='product.non_returnable' value="1" class="flat-red" checked>
            <span>true</span>
          </label>
          <label>
            <input type="radio" name="non_returnable" ng-model='product.non_returnable' value='0'class="flat-red">
            <span>false</span>
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Vatable</label>

        <div class="col-sm-9">          
          <label>
            <input type="radio" name="vatable" ng-model='product.vatable' value="1" class="flat-red" checked>
            <span>true</span>
          </label>
          <label>
            <input type="radio" name="vatable" ng-model='product.vatable' value='0'class="flat-red">
            <span>false</span>
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Lock</label>

        <div class="col-sm-9">          
          <label>
            <input type="radio" name="lock" ng-model='product.lock' value="1" class="flat-red" checked>
            <span>true</span>
          </label>
          <label>
            <input type="radio" name="lock" ng-model='product.lock' value='0'class="flat-red">
            <span>false</span>
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Suspended</label>

        <div class="col-sm-9">          
          <label>
            <input type="radio" name="suspended" ng-model='product.suspended' value="1" class="flat-red" checked>
            <span>true</span>
          </label>
          <label>
            <input type="radio" name="suspended" ng-model='product.suspended' value='0'class="flat-red">
            <span>false</span>
          </label>
        </div>
      </div>
     
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Minimun Stock</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.minimum_stock_quantity' placeholder="1">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Maximum Stock</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="" ng-model='product.maximun_stock_quantity' placeholder="100">
        </div>
      </div>

      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

        <div class="col-sm-9">
         <textarea ng-model='product.notes' class='form-control'></textarea>
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