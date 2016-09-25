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