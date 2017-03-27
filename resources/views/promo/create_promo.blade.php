<div class='col-md-6'>
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Promo</h3>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Product</label>
        <div class="col-sm-8">
          <select class='form-control select2' ng-model="promo.product_id">
            <option>Select</option>
            @foreach($products as $product)
              <<option value="{{$product->product_id}}">{{$product->product_name}}</option>
            @endforeach
          </select>
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Price</label>
        <div class="col-sm-8">
          <input type='text' class='form-control' ng-model='promo.price'/>
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Discount</label>
        <div class="col-sm-8">
          <input type='text' class='form-control' ng-model='promo.discount'/>
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Start</label>
        <div class="col-sm-8">
          <input type='text' class='form-control datepicker' ng-model='promo.start'/>
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">End</label>
        <div class="col-sm-8">
          <input type='text' class='form-control datepicker' ng-model='promo.end'/>
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Non Book</label>

        <div class="col-sm-8">
          <label>
            <input type="checkbox" class="flat-red" id='non-book'ng-model='promo.non_book' >
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label" >Non Consign</label>

        <div class="col-sm-8">
          <label>
            <input type="checkbox"  class="flat-red" id='non_consign'ng-model='promo.non_consign' >
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Lock</label>

        <div class="col-sm-8">
          <label>
            <input type="checkbox" class="flat-red" id='lock'ng-model='promo.lock' >
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Suspended</label>

        <div class="col-sm-8">
          <label>
            <input type="checkbox" class="flat-red" id='suspended'ng-model='promo.suspended' >
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Description</label>
        <div class="col-sm-8">
          <textarea  id='description' class='form-control'></textarea>
       </div>
      </div>
    </div>

  </div>
</div>
