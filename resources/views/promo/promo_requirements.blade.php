<div class='col-md-6'>
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Promo Requirements</h3>
    </div>

    <div class="box-body">
      <table class='table table-striped'>
        <thead>
          <tr>
            <th>Product</th>
            <th>CAT</th>
            <th>QTY</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <hr>
      <div class='clearfix'></div>
      <div class="col-sm-6">
        <select class='form-control select2' ng-model="promo_need.product_id">
          <option selected >Select</option>
          @foreach($products as $product)
            <<option value="{{$product->product_id}}">{{$product->product_name}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-4">
        <input type="text" class="form-control" ng-model="promo_need.qty"/>
      </div>
      <div class='col-sm-2'>
        <a href="javascript:void(0)" class='btn btn-success' ng-click='savePromoNeed(promo_need)'>Add</a>
      </div>
    </div>
  </div>
</div>
