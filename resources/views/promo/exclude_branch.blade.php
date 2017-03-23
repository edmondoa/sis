<div class='col-md-6'>
  <div class="box box-info">
    <div class="box-header with-border">
      <h3 class="box-title">Exclude Branch</h3>
    </div>

    <div class="box-body">
      <div id='branch-exclude'>

      </div>
      <hr>
      <div class='clearfix'></div>
      <div class="col-sm-10">
        <select class='form-control select2 exclude-branch' ng-model="exbranch">
          <option selected >Select</option>
          @foreach($branches as $branch)
            <option value="{{$branch->branch_id.'='.$branch->branch_name}}">{{$branch->branch_name}}</option>
          @endforeach
        </select>
      </div>
      <div class='col-sm-2'>
        <a href="javascript:void(0)" class='btn btn-success' ng-click='pc.saveExclude(exbranch)'>Add</a>
      </div>
    </div>
  </div>
</div>
