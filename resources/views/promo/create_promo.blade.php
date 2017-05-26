 <div class='col-md-6'>
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Promo</h3>
    </div>

    <div class="box-body">
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Product</label>
        <div class="col-sm-8">
          <div class="input-group">
            <input type="hidden" class="form-control " ng-model='promo.product_id' tabindex="8" style='padding:6px 2px !important'>  
            <input type="text" class="form-control " id="searchStr" name='searchStr' tabindex="8" style='padding:6px 2px !important'>
            <a href="#" class='btn btn-sm btn-default input-group-addon  search-prod' ng-click='searchProd()'>
              <i class="fa fa-search"></i>
            </a>
          </div>
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Price</label>
        <div class="col-sm-8">
          <input type='text' class='form-control' id="price" name="price" ng-model='promo.price'/>
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Discount</label>
        <div class="col-sm-8">
          <input type='text' class='form-control' id="discount" name="discount" ng-model='promo.discount'/>
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Start</label>
        <div class="col-sm-8">
          <input type='text' class='form-control datepicker' id="start" name="start" ng-model='promo.start'/>
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">End</label>
        <div class="col-sm-8">
          <input type='text' class='form-control datepicker'id="end"  name="end" ng-model='promo.end'/>
       </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Quantity</label>

        <div class="col-sm-8">         
            <input type="text" class="form-control"   name="max_limit_qty" ng-model='promo.max_limit_qty' >
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Account Limit</label>

        <div class="col-sm-8">
          <input type="text" class="form-control"   name="account_limit_qty" ng-model='promo.account_limit_qty' >
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Non Book</label>

        <div class="col-sm-8">
          <label>
            <input type="checkbox" class="flat-red" id='non_book' name="non_book" ng-model='promo.non_book' >
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label" >Non Consign</label>

        <div class="col-sm-8">
          <label>
            <input type="checkbox"  class="flat-red" id='non_consign' name="non_consign" ng-model='promo.non_consign' >
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Lock</label>

        <div class="col-sm-8">
          <label>
            <input type="checkbox" class="flat-red" id='lock' name="lock" ng-model='promo.lock' >
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Suspended</label>

        <div class="col-sm-8">
          <label>
            <input type="checkbox" class="flat-red" id='suspended' name="suspended" ng-model='promo.suspended' >
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-4 control-label">Description</label>
        <div class="col-sm-8">
          <textarea  id='description' name="description" class='form-control'></textarea>
       </div>
      </div>
    </div>

  </div>
</div>
