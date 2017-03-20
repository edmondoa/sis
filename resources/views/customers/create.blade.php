@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Account Registration
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Record Management</a></li>
        <li class=""><i class="fa fa-circle"></i> Customer</li>
        <li class="active"><i class="fa fa-circle"></i> Registration</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="customerCtrl" >
      <a href="#" class='hide refresh' ></a>
      <div class="box box-info">
        <div class="box-body">
          <div class="box-header with-border">
            <h3 class="box-title col-md-12">
              <a href="#" class="btn btn-lg btn-success pull-right" ng-click="saveCustomer(c)" tabIndex="20">Save</a>
            </h3>
          </div>
          <div class="panel panel-default">
            <div class="panel-body">
              <form class=' col-md-12'>
                <div class=" col-md-6">
                  <div class="col-md-12" >
                    <div class="form-group">
                      <label>Nick Name</label>
                      <input class="form-control" type="text" ng-model='c.nickname' placeholder="Nick Name" tabindex="1"/>
                    </div>
                  </div>
                  <div class="col-md-12" >
                    <div class="form-group">
                      <label>First Name</label>
                      <input type="text" class="form-control" ng-model='c.firstname' placeholder="First Name" tabindex="2">
                    </div>
                  </div>
                  <div class="col-md-12" >
                    <div class="form-group">
                      <label>Middle Name</label>
                      <input class="form-control" type="text" ng-model='c.middlename' placeholder="Middle Name" tabindex="3"/>
                    </div>
                  </div>
                  <div class="col-md-12" >
                    <div class="form-group">
                      <label>Last Name</label>
                      <input class="form-control" type="text" ng-model='c.lastname' placeholder="Last Name" tabindex="4"/>
                    </div>
                  </div>
                  <div class="col-md-12" >
                    <div class="form-group">
                      <label>Status</label>
                      <select ng-model='c.status' class="form-control" tabindex="5">
                        <option value="OK">OK</option>
                        <option value="SUSPENDED">SUSPENDED</option>
                      </select>
                    </div>
                   </div>
                   <div class="col-md-12" >
                     <div class="form-group">
                       <label>TIN No.</label>
                       <input class="form-control" type="text" ng-model='c.tin_no' placeholder="TIN #" tabindex="6"/>
                     </div>
                   </div>
                  <div class="col-md-12" >
                    <div class="form-group">
                      <label>Sex</label>
                      <select ng-model='c.sex' class="form-control" tabindex="7">
                        <option value="M">MALE</option>
                        <option value="F">FEMALE</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12" >
                    <div class="form-group">
                      <label>Civil Status</label>
                      <select ng-model='c.maritalstatus' class="form-control" tabindex="8">
                        <option value="S">SINGLE</option>
                        <option value="M">MARRIED</option>
                        <option value="W">WIDOWED</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12" >
                    <div class="form-group">
                      <label>Birthdate</label>
                      <input class="form-control" ng-model="c.birthdate" type="text" id='datepicker' data-inputmask="&quot;mask&quot;: &quot;99/99/9999&quot;" data-mask="" tabindex="9"/>
                    </div>
                  </div>

                </div>
                <div class="col-md-6">

                  <div class="col-md-12" >
                    <div class="form-group">
                      <label>Email</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <strong class="">@</strong>
                        </div>
                        <input type="text" class="form-control" ng-model='c.email' placeholder="Email" tabindex="10">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6" >
                    <div class="form-group">
                      <label>Mobile 1</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" ng-model="c.mobile1" class="form-control" data-inputmask="&quot;mask&quot;: &quot;99999999999&quot;" data-mask="" tabindex="11">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6" >
                    <div class="form-group">
                      <label>Mobile 2</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" ng-model="c.mobile2" class="form-control" data-inputmask="&quot;mask&quot;: &quot;99999999999&quot;" data-mask="" tabindex="12">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6" >
                    <div class="form-group">
                      <label>Landline</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-phone"></i>
                        </div>
                        <input type="text" ng-model="c.landline" class="form-control" data-inputmask="&quot;mask&quot;: &quot;9999999999&quot;" data-mask="" tabindex="13">
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12" >
                    <div class="form-group">
                      <label>Address Line 1</label>
                      <input class="form-control" type="text" ng-model='c.addressline1' tabindex="15"/>
                    </div>
                   </div>
                   <div class="col-md-12" >
                     <div class="form-group">
                       <label>Address Line 2</label>
                       <input class="form-control" type="text" ng-model='c.addressline2' tabindex="16" />
                     </div>
                    </div>
                    <div class="col-md-12" >
                      <div class="form-group">
                        <label>City</label>
                        <input class="form-control" type="text" ng-model='c.city' tabindex="17"/>
                      </div>
                     </div>
                     <div class="col-md-12" >
                       <div class="form-group">
                         <label>Province</label>
                         <input class="form-control" type="text" ng-model='c.province' tabindex="18"/>
                       </div>
                    </div>

                    <div class="col-md-12" >
                      <div class="form-group">
                        <label>Notes</label>
                        <textarea class="form-control" ng-model="c.notes" tabindex="19" rows="5"></textarea>
                      </div>
                    </div>
               </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/customer.js"></script>

<script src="/plugins/input-mask/jquery.inputmask.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="/plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script>
  $(document).ready(function(){
    $("[data-mask]").inputmask();
    $('#datepicker').datepicker({
      dateFormat: 'yyyy-mm-dd',
      autoclose: true
    });
    $("li.record-management").addClass('active');
    $("li.customer").addClass("active");
    $("li.account").addClass("active");
  })
</script>
@stop
