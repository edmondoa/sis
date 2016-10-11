<link rel="stylesheet" href="/plugins/iCheck/all.css">
<script src="/plugins/iCheck/icheck.min.js"></script>
<style type="text/css">
  .select2-container{width: 100% !important;}
</style>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements    
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  });
</script> 

<div class="nav-tabs-custom">
  <!-- Tabs within a box -->
  <ul class="nav nav-tabs pull-right">
    <li class="active"><a href="#details" data-toggle="tab">Details</a></li>
    <li><a href="#tab-category" data-toggle="tab">Category</a></li>
   
  </ul>
  <div class="tab-content no-padding">
    <!-- Morris chart - Sales -->
    <div class="tab-pane active" id="details" style="">
        <form class="form-horizontal" id='form-suppliers'>
          <div class="box-body">
            <div class="col-md-12">
              <div class="form-group ">
                <label for="inputEmail3"  class="col-sm-3 control-label">Supplier</label>
                <div class="col-sm-9">                  
                  <input type="text" class="form-control"  name='supplier_name' value="{{$supplier->supplier_name}}"placeholder="Supplier">
                </div>  
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-3 control-label">Contact Person</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control"  name='contact_person' value="{{$supplier->contact_person}}" placeholder="Contact Person">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-3 control-label">Mobile # 1</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="" name='mobile1_no' value="{{$supplier->mobile1_no}}"placeholder="Mobile # 1">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-3 control-label">Mobile # 2</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="" name='mobile2_no' value="{{$supplier->mobile2_no}}"placeholder="Mobile # 1">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-3 control-label">Landline #</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="" name='landline_no'value="{{$supplier->landline_no}}" placeholder="Landline #">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-3 control-label">Email</label>

                <div class="col-sm-9">
                  <input type="text" class="form-control" id="" name='email' value="{{$supplier->email}}" placeholder="Email">
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-3 control-label">Lock</label>
                <div class="col-sm-9">
                 <label>
                    <input type="checkbox" class="flat-red" value='1' name='lock' <?php echo ($supplier->lock==1)?'checked':'' ?>>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-3 control-label">Suspended</label>
                <div class="col-sm-9">
                  <label>
                    <input type="checkbox" class="flat-red" value='1' name='suspended' <?php echo ($supplier->suspended==1)?'checked':'' ?>>
                  </label>
                </div>
              </div>
              <div class="form-group">
                <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

                <div class="col-sm-9">
                  <textarea class="form-control" id="" name='notes'>{{$supplier->note}}</textarea>
                  
                </div>
              </div>
                
            </div>
                         
          </div>
          
       </form>
    </div>
    <div class=" tab-pane" id="tab-category" style="">
      
      <div class="box-body">
        <div class="col-md-12">
          <form id='sup_cat'>
          @foreach($categories as $cat)
            
            <div class="form-group col-md-6">
              <label for="inputEmail3"  class="col-sm-6 control-label">{{$cat->category_name}}</label>

              <div class="col-sm-6">
                <input type="checkbox"  id=""  class="flat-red" value='{{$cat->category_id}}' name='category[]' <?php echo (in_array($cat->category_id, $mylist))?'checked':'' ?> >
              </div>
            </div>
           
          @endforeach
           </form>
        </div>
      </div>  
    </div>
  </div>
</div>

