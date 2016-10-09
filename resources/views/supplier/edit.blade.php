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
          <label for="inputEmail3"  class="col-sm-3 control-label">Notes</label>

          <div class="col-sm-9">
            <textarea class="form-control" id="" name='notes'>{{$supplier->note}}</textarea>
            
          </div>
        </div>
          
      </div>
                   
    </div>
    
 </form>