<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Add Stockin 
    	<select class="form-control select2 pull-right" ng-model="stockin.branch_id">
          	@foreach($branches as $branch)
              <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
            @endforeach
        </select>
    </h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal">
    <div class="box-body">     
      <div class="">
        <label for="inputEmail3"  class="col-sm-1 control-label">Supplier</label>

        <div class="col-sm-2">
          <select class="form-control select2" ng-model="stockin.supplier_id" id='supplier_id'>
          	@foreach($suppliers as $sup)
              <option value="{{$sup->supplier_id}}">{{$sup->supplier_name}}</option>
            @endforeach
          </select>         
        </div>
        <label for="inputEmail3"  class="col-sm-1 control-label">Doc #</label>

        <div class="col-sm-2">          
          <div class="input-group">            
            <input type="text" class="form-control" id="" ng-model='stockin.doc_no' >
          </div>
        </div>
        <label for="inputEmail3"  class="col-sm-2 control-label">Amount Due</label>

        <div class="col-sm-2">          
          <div class="input-group">
            <span class="input-group-addon">&#8369;</span>
            <input type="text" class="form-control" id="" ng-model='stockin.amount_due' placeholder="100.00">
          </div>
        </div>      
        <div class="col-sm-2"> 
            <a href="javascript:void(0)" class='btn btn-primary' ng-click="saveStockin(stockin)">Add</a>
        </div>
      <div class="wrapper"></div>
      <br>
      <table class='table table-bordered table-hover dataTable' style="background-color: #f4f4f4;">
      	<thead>
      		<th class='col-sm-1'>Prod Code</th>
      		<th>Prod Name</th>
      		<th class='col-sm-1'>Cost Price</th>
      		<th class='col-sm-1'>Qty</th>
      		<th class='col-sm-1'>Total</th>
      	</thead>
      	<tbody>
      		<tr ng-repeat="stock in stockins">
      			<td ng-bind="stock.product_code"></td>
	      		<td ng-bind="stock.product_name"></td>
	      		<td ng-bind="stock.cost_price"></td>
	      		<td ><input type='text' class='form-control input-sm' style="height:26px"/></td>
	      		<td></td>
      		</tr>
      	</tbody>
      	
      	<tfoot>
      		
      		<td colspan="2"></td>
      		<td>0.00</td>
      		<td>0</td>
      		<td>0.00</td>
      	</tfoot>
      </table>  
      
      <div class="wrapper"></div>
      <div class="row">
        <div class="col-sm-2">          
          <div class="input-group">            
            <input type="text" class="form-control" id="search" name='search' >
            <a href="#" class='btn btn-sm btn-default input-group-addon search-prod'>Search</a>
          </div>
        </div> 
      </div>           
    </div>
    <div class="wrapper"></div>
    <!-- /.box-body -->
    <br>
    <div class="box-footer">
      <button type="reset" class="btn btn-default">Cancel</button>
      <button type="button"  class="btn btn-info pull-right disabled">Save</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>