<div class="box box-info">
  <div class="box-body">   
    <div class="box-header with-border">
      <h3 class="box-title">Add Stockout 
      	
      </h3>
    </div> 
    <div class="panel panel-default">
      <div class="panel-body">
        <form class='form-horizontal col-md-12'>
          <div class="row" style="min-height:80px" id='stockout-div'>     
      
            <input type="hidden" id="stockout_id" />
            @if(Auth::user()->level_id > 2) 
            <div class="col-md-4" >   
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
            </div>
            @else
              <div class="col-md-4" >         
                <div class="form-group ">
                  <label for="inputEmail3"  class="col-sm-4 control-label">Branch</label>
                   
                  <div class="col-sm-7">

                    <label class='form-control'>{{Auth::user()->branch->branch_name}}</label>      
                    <input type='hidden' name='branch_id' id="branch_id"  value="{{Auth::user()->branch_id}}"/>
                  </div>        
                </div>
              </div>  
            @endif
            <div class="col-md-4" > 
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
            </div> 
              
            <div class="col-md-4" >
              <div class="col-md-8">
                <a href="javascript:void(0)" class='btn btn-primary col-md-8 btn-proceed' ng-click="saveStockin()" style="width:100%" tabindex="7"> Proceed</a>
              </div>
            </div>
          </div>        
        </form>
        
 

  <fieldset class='col-sm-12 disabled-all' id='stockitem-div'>    
   
    <table class='table table-bordered table-hover dataTable invoice-table' >
    	<thead>
    		<th class='col-sm-2'>Prod Code</th>
    		<th>Prod Name</th>
    		<th class='col-sm-1 text-right'>Cost Price</th>          
    		<th class='col-sm-1 text-right'>Qty</th>
        <th class='col-sm-1 text-right'>Available</th>
    		<th class='col-sm-1 text-right'>Total</th>
        <th class='col-sm-1'>Action</th>
    	</thead>
    	<tbody ng-show="stockins.length > 0">
    		<tr ng-repeat="stock in stockins" id="@{{$index}}">
    			<td ng-bind="stock.product_code"></td>
      		<td ng-bind="stock.product_name"></td>
      		<td class="text-right" ng-bind="stock.cost_price"></td>                        
      		<td class="text-right" ng-bind="stock.quantity"></td>
          <td> </td>
      		<td class="text-right" ><span class='total' ng-bind="stock.total| number : 2" ng-pattern="/^[0-9]+(\.[0-9]{1,2})?$/" ></span></td>
          <td><a href="javascript:void(0)" title="Remove Item" ng-click="removeItem(stock)"><i class="fa fa-trash text-red"></i></a></td>
    		</tr>
    	</tbody>
    	
    	<tfoot>
    		<tr>
      		<td></td>  
          <td></td>  
      		<td></td>                  
      		<td class='text-right'><strong id='totalQuantity'>0</strong></td>
          <td></td>   
      		<td class='text-right'><strong id='totalCost'>0.00</strong></td>
          <td></td>
        </tr>
        <tr>
          <td>
            <div class="input-group">            
              <input type="text" class="form-control " id="search" name='search' tabindex="8" style='padding:6px 2px !important'>
              <a href="#" class='btn btn-sm btn-default input-group-addon  search-prod'>..</a>
            </div>
          </td>
          <td>
            <span  id="name"></span>
            <input type='hidden' id='prod_id'/>
          </td>
          <td>
            <span  id="cost"></span>
            <input type='hidden' id="cprice"/>
          </td>
          <td>           
            <input type="text" class="form-control " id="qty" name='qty' tabindex="9" style='padding:6px 2px !important'>
            <input type="hidden" class="form-control " id="locked" name='locked'>
          </td>
          <td>
            <span id="available"></span>
          </td>
          <td>
            <span id="total"></span>
          </td>
          <td><a href="#" class='btn btn-primary btn-add' tabindex="10">Add <i class="glyphicon glyphicon-plus-sign"></i></a></td>
        </tr>
    	</tfoot>
    </table> 
    <div class="col-sm-12">
      <div class="col-md-6">
        <!-- Custom Tabs -->
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab"><strong>Notes/Comments</strong></a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
              <textarea id="notes" name='notes' class='form-control'></textarea>
            </div>

          </div>
          <!-- /.tab-content -->
        </div>
      </div>
    </div> 
      
  
    <!-- /.box-body -->
    <br>
    <div class="box-footer text-center">
      <button type="button" class="btn btn-warning" ng-click="cancel()">Cancel</button>
      <button type="button"  class="btn btn-success  btn-save " >Save <span class="glyphicon glyphicon-floppy-disk"></button>
    </div>
    <!-- /.box-footer -->
  </fieldset>
</div>
</div>
    </div>  