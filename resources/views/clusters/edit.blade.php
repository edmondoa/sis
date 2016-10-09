<form class="form-horizontal" method='put' action="/clusters/{{$cluster->cluster_id}}" id='form-cluster'>
<div class="box-body">
  <div class="form-group">
    <label for="inputEmail3"  class="col-sm-4 control-label">Cluster Name</label>

    <div class="col-sm-8">                  
      <input type='text' name="cluster_name" value="{{$cluster->cluster_name}}" class='form-control' placeholder="Cluster Name"/>
   </div>                 
  </div>  
  <div class="form-group">
    <label for="inputEmail3"  class="col-sm-4 control-label">Notes</label>

    <div class="col-sm-8">                  
      <textarea name='notes' class='form-control'>{{$cluster->notes}}</textarea>
   </div>                 
  </div>           
</div>
<!-- /.box-body -->
</form>