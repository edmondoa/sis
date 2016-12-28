@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Transfer     
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Products</li>
        <li class="active"><i class="fa fa-circle"></i> Transfer</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="stockinCtrl">
      <a href="#" class='hide refresh' ng-click="getStockins()"></a>
      @include('transfer.create')
    </section>  
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/stockin.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">

 
  $(function(){
    $(".select2").select2();

  })

 
</script>


@stop
