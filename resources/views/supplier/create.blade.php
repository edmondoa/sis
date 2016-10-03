<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Add Supplier</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal">
    <div class="box-body">
      <div class="col-md-12">
        <div class="form-group ">
          <label for="inputEmail3"  class="col-sm-3 control-label">Supplier</label>
          <div class="col-sm-9">                  
            <select class="form-control select2 supplier_name"ng-model='supplier.sys_supplier_id' >
              @foreach($suppliers as $sup)
              <option value="{{$sup->supplier_id}}">{{$sup->supplier_name}}</option>
              @endforeach
            </select>
          </div>  
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Contact Person</label>

          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='supplier.contact_person' placeholder="Contact Person">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Mobile # 1</label>

          <div class="col-sm-9">
            <input type="text" class="form-control" id="" ng-model='supplier.mobile1_no' placeholder="Mobile # 1">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Mobile # 2</label>

          <div class="col-sm-9">
            <input type="text" class="form-control" id="" ng-model='supplier.mobile2_no' placeholder="Mobile # 1">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Landline #</label>

          <div class="col-sm-9">
            <input type="text" class="form-control" id="" ng-model='supplier.landline_no' placeholder="Landline #">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Email</label>

          <div class="col-sm-9">
            <input type="email" class="form-control" id="" ng-model='supplier.email' placeholder="Email">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

          <div class="col-sm-9">
            <textarea class="form-control" id="" ng-model='supplier.notes'></textarea>
            
          </div>
        </div>
          
      </div>
                   
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="reset" class="btn btn-default">Cancel</button>
      <button type="button" ng-click="saveSupplier(supplier)" class="btn btn-info pull-right">Add</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>