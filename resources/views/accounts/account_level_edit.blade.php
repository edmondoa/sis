<form class="form-horizontal" id="form-acc_level">
  <div class="box-body">
    <div class="form-group">
      <label for="inputEmail3"  class="col-sm-3 control-label">Level Name</label>

      <div class="col-sm-9">                  
        <input type='text' name='level_name' value="{{$acc_level->level_name}}"class='form-control'/>               
      </div>                 
    </div>
    <div class="form-group">
      <label for="inputEmail3"  class="col-sm-3 control-label">Credit Days</label>

      <div class="col-sm-9">                  
        <input type='text' name='credit_days' value="{{$acc_level->credit_days}}" class='form-control'/>               
      </div>                 
    </div>                  
  </div>

  <!-- /.box-footer -->
</form>