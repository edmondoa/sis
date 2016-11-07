<div class="box box-info">
  <div class="box-body"> 
  <fieldset class='col-sm-5' id='stockin-div'>
    <div class="box-header with-border">
      <h3 class="box-title">Add Stockin 
      	
      </h3>
    </div> 
        
    <form class='form-horizontal'>
      <div class="form-group ">
        <label for="inputEmail3"  class="col-sm-4 control-label">Branch</label>

        <div class="col-sm-7">
          <select class="form-control select2 stock "  id="branch_id" tabindex="1">
              <option value="">Select Branch</option>
              @foreach($branches as $branch)
                <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
              @endforeach
          </select>         
        </div>
      </div>
      <div class="form-group ">
        <label for="inputEmail3"  class="col-sm-4 control-label">Supplier</label>

        <div class="col-sm-7">
          <select class="form-control select2 stock"  id='supplier_id' tabindex="2">
          	<option value="">Select Supplier</option>
            @foreach($suppliers as $sup)
              <option value="{{$sup->supplier_id}}">{{$sup->supplier_name}}</option>
            @endforeach
          </select>         
        </div>
      </div>
      <div class="form-group ">  
        <label for="inputEmail3"  class="col-sm-4 control-label">Doc #</label>

        <div class="col-sm-7"> 
            <input type="text" class="form-control " id="doc_no" tabindex="3">
        </div>
      </div>
      <div class="form-group ">
        <label for="inputEmail3"  class="col-sm-4 control-label">Doc Date</label>

        <div class="col-sm-7"  >          
          <div class="input-group"> 
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>           
            <input type="text" class="form-control  calendar" id="doc_date" tabindex="6">
          </div>
        </div>
      </div>
      <div class="form-group ">    
        <label for="inputEmail3"  class="col-sm-4 control-label">Total</label>
        <div class="col-sm-7">          
          <div class="input-group amount-due">
            <span class="input-group-addon">&#8369;</span>
            <input type="text" class="form-control stock" id="amount_due" placeholder="0.00" tabindex="5">
          </div> 
        </div>
      </div>
      <div class="form-group ">  
        <label for="inputEmail3"  class="col-sm-4 control-label">Arrive Date</label>

        <div class="col-sm-7 "  >          
          <div class="input-group ">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            <input type="text" class="form-control  calendar" id="arrive_date" tabindex="4">
          </div>
        </div> 
      </div>  
        
        
      <div class='col-sm-2'></div>
      <div class="col-sm-8" > 
        <a href="javascript:void(0)" class='btn btn-primary  ' ng-click="saveStockin()" style="width:100%" tabindex="7"> Proceed</a>
      </div>
    </form>  
  </fieldset>

  <fieldset class='col-sm-7 disabled-all' id='stockitem-div' disabled> 
    <table class='table'>
      <tr>
        <td class="col-sm-2"></td>
        <td class="col-sm-2">Cat Code</td>
        <td class="col-sm-4">Product</td>
        <td class="col-sm-1">CPrice</td>
        <td class="col-sm-1">Qty</td>
        <td class="col-sm-2"></td>
      </tr>
      <tr>
        <td>
          <div class="input-group">            
            <input type="text" class="form-control " id="search" name='search' tabindex="8" style='padding:6px 2px !important'>
            <a href="#" class='btn btn-sm btn-default input-group-addon  search-prod'>..</a>
          </div>
        </td>
        <td><span  id="code"></span></td>
        <td><span  id="name"></span></td>
        <td>
          <input type="text" class="form-control " id="cprice" name='cprice' style='padding:6px 2px !important'>
          <input type="hidden" class="form-control " id="prod_id" name='prod_id' > 
        </td>
        <td>          
          <input type="text" class="form-control " id="qty" name='qty' tabindex="9" style='padding:6px 2px !important'>
          <input type="hidden" class="form-control " id="locked" name='locked'>
        </td>
        <td><a href="#" class='btn btn-primary btn-add' tabindex="10">Add</a></td>
      </tr>
    </table>    

    
   
    <table class='table table-bordered table-hover dataTable' style="background-color: #f4f4f4;">
    	<thead>
    		<th class='col-sm-2'>Prod Code</th>
    		<th>Prod Name</th>
    		<th class='col-sm-1'>Cost Price</th>          
    		<th class='col-sm-1'>Qty</th>
    		<th class='col-sm-1'>Total</th>
        <th class='col-sm-1'></th>
    	</thead>
    	<tbody>
    		<tr ng-repeat="stock in stockins" id="@{{$index}}">
    			<td ng-bind="stock.product_code"></td>
      		<td ng-bind="stock.product_name"></td>
      		<td ng-bind="stock.cost_price"></td>                        
      		<td ng-bind="stock.quantity"></td>
      		<td><span class='total' >@{{stock.total}}</span></td>
          <td><a href="javascript:void(0)" title="Remove Item" ng-click="removeItem($index)"><i class="fa fa-trash text-red"></i></a></td>
    		</tr>
    	</tbody>
    	
    	<tfoot>
    		
    		<td colspan="2"></td>
    		<td></td>          
    		<td><strong id='totalQuantity'>0</strong></td>
    		<td><strong id='totalCost'>0.00</strong></td>
    	</tfoot>
    </table>  
      
  
    <!-- /.box-body -->
    <br>
    <div class="box-footer">
      <button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button>
      <button type="button"  class="btn btn-info pull-right btn-save " >Save</button>
    </div>
    <!-- /.box-footer -->
  </fieldset>
</div>