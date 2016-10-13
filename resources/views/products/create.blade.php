<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Add Product</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal">
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
            <input type="text" class="form-control" id="" ng-model='product.retail_price' placeholder="100.00">
            
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Cost Price</label>

        <div class="col-sm-8">
         <div class="input-group">
            <span class="input-group-addon">&#8369;</span>
            <input type="text" class="form-control" id="" ng-model='product.cost_price' placeholder="100.00">
            
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
    <div class="box-footer">
      <button type="reset" class="btn btn-default">Cancel</button>
      <button type="button" ng-click="saveProduct(product)" class="btn btn-info pull-right">Add</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>