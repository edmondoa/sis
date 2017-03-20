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
    <section class="content details" ng-controller="customerCtrl">

      <div class="box box-info">
        <div class="box-body">
          <div class="box-header with-border">
            <h3 class="box-title col-md-12">
            </h3>
          </div>
          <div class="panel panel-default">
            <div class="panel-body">
              <form class=' form-horizontal col-md-12'>
                <div class="col-md-12" >
                    <label for="inputEmail3"  class="col-sm-2 text-right">Status :</label>
                    <span for="inputEmail3"  class="col-sm-3 {{($customer->status =='OK') ? 'alert-success':'alert-danger'}} ">{{$customer->status}}</span>
              </div>
                <div class="col-md-12" >
                    <label for="inputEmail3"  class="col-sm-2 text-right">Full Name :</label>
                    <span for="inputEmail3"  class="col-sm-7 ">{{$customer->firstname.' '.$customer->middlename.' '.$customer->lastname}}</span>
              </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Nick Name :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->nickname}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Birth Date :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->birthdate}}</span>
                </div>
                <div class="col-md-12" >
                    <label for="inputEmail3"  class="col-sm-2 text-right">Sex :</label>
                    <span for="inputEmail3"  class="col-sm-7 ">{{Config::get('properties.sex')[$customer->sex]}}</span>
                </div>
                <div class="col-md-12" >
                    <label for="inputEmail3"  class="col-sm-2 text-right">Marital Status :</label>
                    <span for="inputEmail3"  class="col-sm-7">{{Config::get('properties.maritalstatus')[$customer->maritalstatus]}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">TIN NO :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->tin_no}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Email :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->email}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Mobile 1 :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->mobile1}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Mobile 2 :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->mobile2}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Landline :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->landline}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Address Line 1 :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->addressline1}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Address Line 2 :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->addressline2}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">City :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->city}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Province :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->province}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Notes :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->notes}}</span>
                </div>
                <div class="col-md-12" >
                  <label for="inputEmail3"  class="col-sm-2 text-right">Created By :</label>
                  <span for="inputEmail3"  class="col-sm-7 ">{{$customer->user->username}}</span>
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
