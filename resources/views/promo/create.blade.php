@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/iCheck/all.css">
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><a href="/products-promo"><i class="fa fa-circle"></i> Promo</a></li>
        <li class="active"><i class="fa fa-circle"></i> Create</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="promoCtrl as pc">
      <form class="form-horizontal">
      <div class="row">
        @include('promo.create_promo')
        @include('promo.promo_requirements')
        @include('promo.exclude_branch')
      </div>
      <br>
      <div class="text-center">
        <button type="button" class="btn btn-warning" ng-click="cancel()">Cancel</button>
        <button type="button"  class="btn btn-success  btn-save " ng-click="savePromo(promo,need)">Save <span class="glyphicon glyphicon-floppy-disk"></button>
      </div>
    </form>
    </section>
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/promo.js"></script>
<script src="/angular/service/HttpRequestFactory.js"></script>
<script src="/angular/service/promoService.js"></script>
<script src="/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){
    $("li.record-management").addClass('active');
    $("li.product").addClass('active');
    $("li.promo").addClass('active');

    $(".datepicker").datepicker({
      dateFormat: 'yyyy-mm-dd',
      autoclose: true});
  });

  $(document).on('click',".btn-exclude",function(){
    id = $(this).data('id');
    text = $(this).text();
    $(this).remove();
    var opt = "<option value='"+id+"="+text+"'>"+text+"</option";
    $("select.exclude-branch").append(opt);
  })
  $(function(){
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });
  })

</script>
@stop
