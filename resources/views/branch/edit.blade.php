<link rel="stylesheet" href="/plugins/iCheck/all.css">
<link rel="stylesheet" href="/plugins/select2/select2.min.css">
<script src="/plugins/select2/select2.full.min.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>
<style type="text/css">
  .select2-container{width: 100% !important;}
</style>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script>  
<form class="form-horizontal" id='form-branches'  method='put' action="/branches/{{$branch->branch_id}}">
  <div class="box-body">
    <div class="col-md-12">
      <div class="form-group ">
        <label for="inputEmail3"  class="col-sm-3 control-label">Business Name</label>
        <div class="col-sm-9">
          <input type="text" class="form-control"  name='business_name' value="{{$branch->business_name}}" placeholder="Business Name">
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Branch Name</label>
        <div class="col-sm-9">
          <input type="text" class="form-control"  name='branch_name' value="{{$branch->branch_name}}" placeholder="Branch Name">
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Cluster</label>
        <div class="col-sm-9">
          <select class="form-control select2 cluster_name"name='cluster_id' >
            @foreach($clusters as $cluster)
            <option value="{{$cluster->cluster_id}}" {{($branch->cluster_id ==$cluster->cluster_id )?'selected':''}}>{{$cluster->cluster_name}}</option>
            @endforeach
          </select>
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Address 1</label>
        <div class="col-sm-9">
          <textarea class="form-control"  name='addressline1'>{{$branch->addressline1}}</textarea>
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Address 2</label>
        <div class="col-sm-9">
          <textarea class="form-control"  name='addressline2'>{{$branch->addressline2}}</textarea>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">TIN #</label>
        <div class="col-sm-9">
          <input type="text" class="form-control"  name='tin_no' value="{{$branch->tin_no}}" placeholder="TIN #">
        </div>
      </div> 
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Lock</label>
        <div class="col-sm-9">
         <label>
            <input type="checkbox" class="flat-red" value='1' name='lock' <?php echo ($branch->lock==1)?'checked':'' ?>>
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Suspended</label>
        <div class="col-sm-9">
          <label>
            <input type="checkbox" class="flat-red" value='1' name='suspended' <?php echo ($branch->suspended==1)?'checked':'' ?>>
          </label>
        </div>
      </div>
      <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>
        <div class="col-sm-9">
          <textarea class="form-control"  name='notes'>{{$branch->notes}}</textarea>
        </div>
      </div>     
      <!-- <div class="form-group">
        <label for="inputEmail3"  class="col-sm-3 control-label">Credit Limit </label>
        <div class="col-sm-9">
          <input type="text" class="form-control"  ng-model='branch.default_credit_limit' placeholder="100.00">
        </div>
      </div> -->
      
    </div>
    
                 
  </div>
 
</form>