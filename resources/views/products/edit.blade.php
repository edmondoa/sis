<link rel="stylesheet" href="/plugins/iCheck/all.css">
<link rel="stylesheet" href="/plugins/select2/select2.min.css">
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<style type="text/css">
  .select2-container{width: 100% !important;}
</style>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script> 
<form class="form-horizontal" id="form-product">
    <div class="box-body">
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Category</label>

        <div class="col-sm-9">
          <select class='form-control' name='category_id' >            
            @foreach($category as $cat)
            <option value="{{$cat->category_id}}" {{($cat->category_id == $product->category_id)?'selected':''}} >{{$cat->category_name}}</option>
            @endforeach
          </select>
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Code</label>

        <div class="col-sm-9">
          <input type="text" class="form-control" id="product_code" name='product_code' value="{{$product->product_code}}" placeholder="Product Code">
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Bar Code</label>

        <div class="col-sm-9">
          <input type="text" class="form-control"  value="{{$product->barcode}}" name='barcode' placeholder="Bar Code">
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Model #</label>

        <div class="col-sm-9">
          <input type="text" class="form-control"  value="{{$product->model_no}}" name='model_no' placeholder="Model">
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Product</label>

        <div class="col-sm-9">
          <input type="text" class="form-control"  value="{{$product->product_name}}" name='product_name' placeholder="Product Name">
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Retail Price</label>

        <div class="col-sm-9">          
          <div class="input-group">
            <span class="input-group-addon">&#8369;</span>
            <input type="text" class="form-control"  value="{{$product->retail_price}}" name='retail_price' placeholder="0.00">
            
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Cost Price</label>

        <div class="col-sm-9">
         <div class="input-group">
            <span class="input-group-addon">&#8369;</span>
            <input type="text" class="form-control"  value="{{$product->cost_price}}" name='cost_price' placeholder="0.00">
            
          </div>
          
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Discount</label>

        <div class="col-sm-9">
          <select class='form-control' name='discount_id' >            
            @foreach($discount as $dis)
            <option value="{{$dis->discount_id}}" {{($dis->discount_id == $product->discount_id)?'selected':''}}>{{$dis->account_level->level_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
       <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Group</label>

        <div class="col-sm-9">
          <select class='form-control' name='group_id' >            
            @foreach($groups as $group)
            <option value="{{$group->group_id}}" {{($group->group_id == $product->group_id)?'selected':''}}>{{$group->group_name}}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Book</label>

        <div class="col-sm-9">
          <label>
            <input type="checkbox" class="flat-red" id='non-book'name='non_book' {{( $product->non_book==1)?'checked':''}}>
          </label>
        </div> 
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Consign</label>

        <div class="col-sm-9">          
          <label>
            <input type="checkbox" class="flat-red" id='non_consign'name='non_consign' {{( $product->non_consign==1)?'checked':''}}>
          </label>  
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Returnable</label>

        <div class="col-sm-9">      
          <label>
            <input type="checkbox" class="flat-red" id='non_returnable'name='non_returnable' {{( $product->non_returnable==1)?'checked':''}} >
          </label>           
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Vatable</label>

        <div class="col-sm-9">   
          <label>
            <input type="checkbox" class="flat-red" name='vatable' {{( $product->vatable==1)?'checked':''}}>
          </label> 
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Lock</label>

        <div class="col-sm-9">  
          <label>
            <input type="checkbox" class="flat-red" id='lock'name='lock' {{( $product->lock==1)?'checked':''}}>
          </label> 
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Tie up</label>

        <div class="col-sm-9"> 
          <label>
            <input type="checkbox" class="flat-red" id='tieup'name='tieup' {{( $product->tieup==1)?'checked':''}}>
          </label>          
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Suspended</label>

        <div class="col-sm-9"> 
          <label>
            <input type="checkbox" class="flat-red" id='suspended'name='suspended' {{( $product->suspended==1)?'checked':''}} >
          </label>          
       </div>
      </div>
     
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

        <div class="col-sm-9">
         <textarea name='notes' class='form-control'>{{ $product->suspended}}</textarea>
        </div>
      </div>
                         
    </div>
   
  </form>