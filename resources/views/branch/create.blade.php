<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">Add Branches</h3>
  </div>
  <!-- /.box-header -->
  <!-- form start -->
  <form class="form-horizontal">
    <div class="box-body">
      <div class="col-md-6">
        <div class="form-group ">
          <label for="inputEmail3"  class="col-sm-3 control-label">Business Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.business_name' placeholder="Business Name">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Branch Name</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.branch_name' placeholder="Branch Name">
          </div>
        </div> 
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Address 1</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.addressline1' placeholder="Address 1">
          </div>
        </div> 
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Address 2</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.addressline2' placeholder="Address 2">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">TIN #</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.tin_no' placeholder="TIN #">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Terminal Type</label>
          <div class="col-sm-9">
            <select class='form-control' ng-model='branch.terminal_type'>
              <option value='FRONT'>FRONT</option>
              <option value='BACK'>BACK</option>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Credit Limit </label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.default_credit_limit' placeholder="100.00">
          </div>
        </div>
      </div>
      <div class="col-md-6">
        
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Header 1</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.invoice_header1' placeholder="Invoice Header 1">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Header 2</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.invoice_header2' placeholder="Invoice Header 2">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Header 3</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.invoice_header3' placeholder="Invoice Header 3">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Footer 1</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.invoice_footer1' placeholder="Invoice Footer 1">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Footer 2</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.invoice_footer2' placeholder="Invoice Footer 2">
          </div>
        </div>
        <div class="form-group">
          <label for="inputEmail3"  class="col-sm-3 control-label">Footer 3</label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  ng-model='branch.invoice_footer3' placeholder="Invoice Footer 3">
          </div>
        </div>
      </div>
      
                   
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      <button type="reset" class="btn btn-default">Cancel</button>
      <button type="button" ng-click="saveBranch(branch)" class="btn btn-info pull-right">Add</button>
    </div>
    <!-- /.box-footer -->
  </form>
</div>