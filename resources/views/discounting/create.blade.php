<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Create Discount</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal">
    <div class="box-body">
      <div class="col-md-12">
        <div class="form-group ">
          <label for="inputEmail3"  class="col-sm-3 control-label">Category</label>
          <div class="col-sm-9">                  
            <select class="form-control select2 category_name"ng-model='discount.category_id' >
              @foreach($categorys as $cat)
              <option value="{{$cat->category_id}}">{{$cat->category_name}}</option>
              @endforeach
            </select>
          </div>  
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Level</label>
          <div class="col-sm-9">                  
            <select class="form-control select2 category_name"ng-model='discount.level_id' >
              @foreach($acc_level as $level)
              <option value="{{$level->level_id}}">{{$level->level_name}}</option>
              @endforeach
            </select>
          </div> 
        </div> 
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Cash</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='discount.cash' placeholder="100.00">
          </div>
        </div> 
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Credit</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='discount.credit' placeholder="100.00">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>
          <div class="col-sm-9">
            <textarea class='form-control' ng-model='discount.notes'></textarea>            
          </div>
        </div>   
      </div>
                   
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="reset" class="btn btn-default">Cancel</button>
      <button type="button" ng-click="saveDiscount(discount)" class="btn btn-info pull-right">Add</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>