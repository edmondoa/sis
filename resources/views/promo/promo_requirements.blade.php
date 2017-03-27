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
            <th style="width:10px">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr ng-repeat="ne in pc.need">
            <td ng-bind='ne.name'> </td>
            <td ng-bind='ne.category'> </td>
            <td ng-bind='ne.qty'> </td>
            <td ng-bind-html="ne.action | unsafe"> </td>
          </tr>
        </tbody>
      </table>
      <hr>
      <div class='clearfix'></div>
      <div class="col-sm-6">
        <select class='form-control select2' ng-model="promo_need.product">
          <option selected >Select</option>
          @foreach($products as $product)
            <option value="{{$product->product_id.'='.$product->category->category_name.'='.$product->product_name}}" data-id="">{{$product->product_name}}</option>
          @endforeach
        </select>
      </div>
      <div class="col-sm-4">
        <input type="text" class="form-control" ng-model="promo_need.qty"/>
      </div>
      <div class='col-sm-2'>
        <a href="javascript:void(0)" class='btn btn-success' ng-click='pc.savePromoNeed(promo_need)'>Add</a>
      </div>
    </div>
  </div>
</div>
