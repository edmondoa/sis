<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">New Product Storage</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal">
    <div class="box-body">
      <div class="col-md-12">     
        @if(Auth::user()->level_id != 1)
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Branch</label>

          <div class="col-sm-9">
            <select class='form-control' ng-model='pr.branch_id' >            
              @foreach($branches as $branch)
              <option value="{{$branch->branch_id}}">{{$branch->branch_name}}</option>
              @endforeach
            </select>
          </div>
        </div>
        @else
          <input type="hidden" class="form-control"   ng-init='pr.branch_id = {{Auth::user()->branch_id}}' ng-model='pr.branch_id'>
        @endif
        <div class="form-group ">
          <label for="inputEmail3"  class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">                  
            <input type="text" class="form-control"  ng-model='pr.storage_name' placeholder="Storage Name">
          </div>  
        </div>        
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

          <div class="col-sm-9">
            <textarea class="form-control" id="" ng-model='pr.notes'></textarea>
            
          </div>
        </div>
          
      </div>
                   
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="reset" class="btn btn-default">Cancel</button>
      <button type="button" ng-click="saveStorage(pr)" class="btn btn-info pull-right">Add</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>