<form class="form-horizontal" id='form-category'>
  <div class="box-body">
    @if(Auth::user()->level_id != 1)
    <div class="form-group">
      <label for="inputEmail3"  class="col-sm-4 control-label">System Category</label>
      <div class="col-sm-8">                  
         <select class="form-control select2 sys_category_id "disabled name='sys_category_id' >
                    @foreach($sys_category as $cat)
                    <option value="{{$cat->category_id}}" {{($cat->category_id == $category->sys_category_id)?'selected':''}}>{{$cat->category_name}}</option>
                    @endforeach
                  </select>
      </div>       
    </div> 
    @else 
    <input type='hidden' name="sys_category_id" value="{{$category->sys_category_id}}"/>
    @endif
    <div class="form-group">
      <label for="inputEmail3"  class="col-sm-4 control-label">Name</label>
      <div class="col-sm-8">                  
        <input type='text' name="category_name" class='form-control' value="{{$category->category_name}}" placeholder="Category Name"/>
      </div>       
    </div> 
    <div class="form-group">
      <label for="inputEmail3"  class="col-sm-4 control-label">Category Code</label>
      <div class="col-sm-8">                  
        <input type='text' name="category_code" class='form-control' value="{{$category->category_code}}" placeholder="Category Name"/>
      </div>       
    </div>            
  </div>
  
  <!-- /.box-footer -->
</form>