<link rel="stylesheet" href="/plugins/select2/select2.min.css">
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>  
<form class="form-horizontal" id="form-product-storage">
    <div class="box-body">
      <div class="col-md-12">
        <input type='hidden' name='branch_id' value="$storage->branch_id">
        
        <div class="form-group ">
          <label for="inputEmail3"  class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">                  
            <input type="text" class="form-control"  name='storage_name' value='{{$storage->storage_name}}'placeholder="Storage Name">
          </div>  
        </div>        
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

          <div class="col-sm-9">
            <textarea class="form-control" id="" name='notes'>{{$storage->notes}}</textarea>
            
          </div>
        </div>
          
      </div>
                   
    </div>
 
</form>