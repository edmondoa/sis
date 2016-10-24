<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Add Stockin 
    	<select class="form-control select2 stock "  id="branch_id">
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
        <div class="row">
          <label for="inputEmail3"  class="col-sm-2 control-label">Supplier</label>

          <div class="col-sm-2">
            <select class="form-control select2 stock"  id='supplier_id'>
            	@foreach($suppliers as $sup)
                <option value="{{$sup->supplier_id}}">{{$sup->supplier_name}}</option>
              @endforeach
            </select>         
          </div>
          <label for="inputEmail3"  class="col-sm-1 control-label">Doc #</label>

          <div class="col-sm-2">          
            <div class="input-group">            
              <input type="text" class="form-control stock" id="doc_no" >
            </div>
          </div>
          <label for="inputEmail3"  class="col-sm-2 control-label">Arrive Date</label>

          <div class="col-sm-2">          
            <div class="input-group ">
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
              <input type="text" class="form-control stock calendar" id="arrive_date" >
            </div>
          </div> 
        </div>
        <br>
        <div class="row">
          <label for="inputEmail3"  class="col-sm-2 control-label">Amount Due</label>
          <div class="col-sm-2">          
            <div class="input-group amount-due">
              <span class="input-group-addon">&#8369;</span>
              <input type="text" class="form-control stock" id="amount_due" placeholder="100.00">
            </div>
          </div>
          <label for="inputEmail3"  class="col-sm-1 control-label">Doc Date</label>

          <div class="col-sm-2">          
            <div class="input-group"> 
              <span class="input-group-addon"><i class="fa fa-calendar"></i></span>           
              <input type="text" class="form-control stock calendar" id="doc_date" >
            </div>
          </div>
          <div class='col-sm-2'></div>
          <div class="col-sm-2"> 
            <a href="javascript:void(0)" class='btn btn-primary stock btn-add' ng-click="saveStockin()" style="width:100%">Add</a>
          </div>  
          
        </div>
        
      <div class="wrapper"></div>
      <br>
      <table class='table table-bordered table-hover dataTable' style="background-color: #f4f4f4;">
      	<thead>
      		<th class='col-sm-2'>Prod Code</th>
      		<th>Prod Name</th>
      		<th class='col-sm-1'>Cost Price</th>
          <th class='col-sm-1'>Updated Price</th>
      		<th class='col-sm-1'>Qty</th>
      		<th class='col-sm-1'>Total</th>
          <th class='col-sm-1'></th>
      	</thead>
      	<tbody>
      		<tr ng-repeat="stock in stockins" id="@{{$index}}">
      			<td ng-bind="stock.product_code"></td>
	      		<td ng-bind="stock.product_name"></td>
	      		<td ng-bind="stock.cost_price"></td>
            <td ><input type='text' class='form-control input-sm updated_price' value="@{{stock.updated_price}}" name="updated_price[]" 
                data-prodid="@{{stock.product_id}}"
                data-costprice='@{{stock.cost_price}}' style="height:26px"/></td>            
	      		<td ><input type='number' class='form-control input-sm quantity' min="0" value="@{{stock.quantity}}" name="quantity[]" 
                data-prodid="@{{stock.product_id}}"
                data-updatedprice='@{{stock.updated_price}}' data-costprice='@{{stock.cost_price}}'  style="height:26px"/></td>
	      		<td><span class='total' >@{{stock.total}}</span></td>
            <td><a href="javascript:void(0)" title="Remove Item" ng-click="removeItem($index)"><i class="fa fa-trash text-red"></i></a></td>
      		</tr>
      	</tbody>
      	
      	<tfoot>
      		
      		<td colspan="2"></td>
      		<td></td>
          <td></td>
      		<td><strong id='totalQuantity'>0</strong></td>
      		<td><strong id='totalCost'>0.00</strong></td>
      	</tfoot>
      </table>  
      
      <div class="wrapper"></div>
      <div class="row">
        <div class="col-sm-2">          
          <div class="input-group">            
            <input type="text" class="form-control " id="search" name='search' >
            <a href="#" class='btn btn-sm btn-default input-group-addon disabled search-prod'>Search</a>
          </div>
        </div> 
      </div>           
    </div>
    <div class="wrapper"></div>
    <!-- /.box-body -->
    <br>
    <div class="box-footer">
      <button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button>
      <button type="button"  class="btn btn-info pull-right btn-save disabled" >Save</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>