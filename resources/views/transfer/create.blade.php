<div class="box box-info">
  <div class="box-body"> 
    <div class="panel panel-default">
      <div class="panel-body">
        <form class='form-horizontal col-md-12'>
          <div class="row" style="min-height:100px" id='stockin-div'>
            <div class="col-md-4" >
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-5 control-label">Originating Branch</label>

                <div class="col-sm-7">
                  @if(Auth::user()->level_id > 2)
                    <select class="form-control select2 stock "  id="branch_id_from" tabindex="1">
                      <option value="">Select Branch</option>
                      @foreach($branches as $branch)
                        <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                      @endforeach
                    </select> 
                  @else
                    <label class='form-control'>{{Auth::user()->branch->branch_name}}</label>
                    <input type='hidden' id="branch_id"  name='branch_id' value="{{Auth::user()->branch->branch_id}}"/>
                  @endif
                </div>
              </div>
            </div> 
            <div class='col-md-4'>
              <div class="form-group ">
                <label for="inputEmail3"  class="col-sm-5 control-label">Recieving Branch</label>
                 
                <div class="col-sm-7">
                  <select class="form-control select2 stock "  id="branch_id_to" tabindex="1">
                      <option value="">Select Branch</option>
                      @foreach($branches as $branch)
                        <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
                      @endforeach
                  </select>         
                </div>        
              </div>
            </div> 
            <div class="col-md-4">
              <div class='col-sm-8'>
                <a href="javascript:void(0)" class='btn btn-primary btn-proceed ' ng-click="saveTranser()" style="width:100%" tabindex="7"> Proceed</a>
              </div>
            </div>
          </div>
        </form>       
        <fieldset class='col-sm-12 disabled-all' id='stockitem-div' >    
         
          <table class='table table-bordered table-hover dataTable invoice-table' style="background-color: #f4f4f4;">
          	<thead>          		
              <th class="col-sm-2">Product Code</th>
              <th class="">Product Name</th>
              <th class='col-sm-1 text-right'>Cost Price</th>
              <th class='col-sm-1 text-right'>Qty</th>
              <th class='col-sm-1 text-right'>Available</th>
              <th class='col-sm-1 text-right'>Total</th>
              <th class='col-sm-1'>Action</th>
          	</thead>
          	<tbody>
          		<tr ng-repeat="stock in products" id="@{{$index}}">
          			<td ng-bind="stock.product_code"></td>
            		<td ng-bind="stock.product_name"></td>
            		<td class="text-right" ng-bind="stock.cost_price"></td>                        
            		<td class="text-right" ng-bind="stock.quantity"></td>
                <td class="text-right" ng-bind="stock.available"></td>
            		<td><span class='total text-right' ng-bind="stock.total"></span></td>
                <td><a href="javascript:void(0)" title="Remove Item" ng-click="removeItem(stock)"><i class="fa fa-trash text-red"></i></a></td>
          		</tr>
          	</tbody>
          	
          	<tfoot>
          		<tr>
                <td colspan="2"></td>
                <td></td> 
                <td class="text-right"><strong id='totalQuantity'>0</strong></td>
                <td class="text-right"></td> 
                <td class="text-right"><strong id='totalCost'>0.00</strong></td>
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
            
        
          <!-- /.box-body -->
          <br>
          <div class="box-footer">
            <button type="button" class="btn btn-default" ng-click="cancel()">Cancel</button>
            <button type="button"  class="btn btn-info pull-right btn-save " >Save</button>
          </div>
          <!-- /.box-footer -->
        </fieldset>
      </div>
    </div>
  </div>      
</div>