<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">New Product Group</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal">
    <div class="box-body">
      <div class="col-md-12">
        <div class="form-group ">
          <label for="inputEmail3"  class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">                  
            <input type="text" class="form-control"  ng-model='group.group_name' placeholder="Group Name">
          </div>  
        </div>        
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

          <div class="col-sm-9">
            <textarea class="form-control" id="" ng-model='group.notes'></textarea>
            
          </div>
        </div>
          
      </div>
                   
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="reset" class="btn btn-default">Cancel</button>
      <button type="button" ng-click="saveGroup(group)" class="btn btn-info pull-right">Add</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>