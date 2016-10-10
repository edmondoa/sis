<form class="form-horizontal" id="form-product-group">
  <div class="box-body">
    <div class="col-md-12">
      <div class="form-group ">
        <label for="inputEmail3"  class="col-sm-3 control-label" >Name</label>
        <div class="col-sm-9">                  
          <input type="text" class="form-control"  name='group_name' value="{{$group->group_name}}"placeholder="Group Name">
        </div>  
      </div>        
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

        <div class="col-sm-9">
          <textarea class="form-control" id="" name='notes'>{{$group->notes}}</textarea>
          
        </div>
      </div>
        
    </div>
                 
  </div>
  
  <!-- /.box-footer -->
</form>