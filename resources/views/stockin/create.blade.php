<div class="box box-info">
  <div class="box-body">
  <div class="panel panel-default">
    <div class="panel-body">
      <form class='form-horizontal'>
        <div class="row" style="min-height:145px" id='stockin-div'>
          <div class="col-md-4" >
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Branch</label>

              <div class="col-sm-8">
                @if(Auth::user()->level_id > 2)
                  <select class="form-control select2 stock "  id="branch_id" tabindex="1">
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
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Supplier</label>
              <div class="col-sm-8">
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
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Doc #</label>
              <div class="col-sm-8">
                <input type="text" class="form-control " id="doc_no" tabindex="3">
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Doc Date</label>
              <div class="col-sm-8">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" class="form-control " id="doc_date" tabindex="6" >

                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4" >

            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Arrived Date</label>
              <div class="col-sm-8">
                <div class="input-group ">
                  <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                  <input type="text" class="form-control  " id="arrive_date" tabindex="4">

                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label">Total</label>
              <div class="col-sm-8">
                <div class="input-group amount-due">
                  <span class="input-group-addon">&#8369;</span>
                  <input type="text" class="form-control stock" id="amount_due" placeholder="0.00" tabindex="6">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail3" class="col-sm-4 control-label"></label>
              <div class="col-sm-8">
                <a href="javascript:void(0)" class='btn btn-primary btn-proceed ' ng-click="saveStockin()" style="width:100%" tabindex="7"> Proceed</a>
              </div>
            </div>
          </div>
        </div>
      </form>

      <fieldset class='col-sm-12 disabled-all' id='stockitem-div' >

        <table class='table table-bordered table-hover dataTable invoice' >
        	<thead>
        		<th class='col-sm-2'>Product Code</th>
        		<th class='col-sm-6'>Product Name</th>
        		<th class='col-sm-1'>Cost Price</th>
        		<th class='col-sm-1'>Quantity</th>
        		<th class='col-sm-1'>Total</th>
            <th class='col-sm-1'>Action</th>
        	</thead>
        	<tbody>
        		<tr ng-repeat="stock in stockins" id="@{{$index}}">
        			<td ng-bind="stock.product_code"></td>
          		<td ng-bind="stock.product_name"></td>
          		<td class="text-right"ng-bind="stock.cost_price"></td>
          		<td class="text-right"ng-bind="stock.quantity"></td>
          		<td class="text-right"><span class='total' ng-bind="stock.total"></span></td>
              <td><a href="javascript:void(0)" title="Remove Item" ng-click="removeItem($index)"><i class="fa fa-trash text-red"></i></a></td>
        		</tr>
        	</tbody>

        	<tfoot>
        		<tr>
          		<td colspan="2"></td>
          		<td></td>
          		<td class="text-right"><strong id='totalQuantity'>0</strong></td>
          		<td class="text-right"><strong id='totalCost'>0.00</strong></td>
            </tr>
            <tr >
              <td>
                <div class="input-group">
                  <input type="text" class="form-control " id="search" name='search' tabindex="8" style='padding:6px 2px !important'>
                  <a href="#" class='btn btn-sm btn-default input-group-addon  search-prod'>..</a>
                </div>
              </td>
              <td><span  id="name"></td>
              <td>
                <input type="text" class="form-control " id="cprice" name='cprice' style='padding:6px 2px !important'>
                <input type="hidden" class="form-control " id="prod_id" name='prod_id' >
              </td>
              <td>
                <input type="text" class="form-control " id="qty" name='qty' tabindex="9" style='padding:6px 2px !important'>
                <input type="hidden" class="form-control " id="locked" name='locked'>
              </td>
              <td></td>
              <td>
                <a href="#" class='btn btn-primary btn-add' tabindex="10">Add <i class="fa fa-5 fa-plus-circle" aria-hidden='true'></i></a>
              </td>
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
                  <textarea name='notes' class='form-control'></textarea>
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
          <button type="button"  class="btn btn-success btn-save " >Save <span class="glyphicon glyphicon-floppy-disk"></span></button>
        </div>
        <!-- /.box-footer -->
      </fieldset>

     </div>
    </div>
  </div>
</div>
