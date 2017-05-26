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
          <tr ng-repeat="ne in need">
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
          <div class="input-group">
            <input type="hidden" class="form-control " ng-model='promo_need.product' tabindex="8" style='padding:6px 2px !important'>  
            <input type="text" class="form-control " id="searchStr2" name='searchStr2' tabindex="8" style='padding:6px 2px !important'>
            <a href="#" class='btn btn-sm btn-default input-group-addon  search-prod' ng-click='searchProd2()'>
              <i class="fa fa-search"></i>
            </a>
          </div>
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
