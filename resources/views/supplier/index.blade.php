@extends('layouts.master')

@section('content')
    <link rel="stylesheet" href="/plugins/select2/select2.min.css">
    <section class="content-header">
      <h1>
        Suppliers     
      </h1>
      <ol class="breadcrumb">
        <li><a href="/"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class=""><i class="fa fa-circle"></i> Settings</li>
        <li class="active"><i class="fa fa-circle"></i>Supplier</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content" ng-controller="discountCtrl">
      <div class='col-md-4'>
        @include('supplier.create')
      </div>
      <div class='col-md-8'>
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">List</h3>
          </div>
            <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-bordered">
              <tr>
                <th style="width: 10px">#</th>  
                <th>Supplier</th>              
                <th>Category</th> 
                <th>Cash</th>              
                <th>Credit</th>             
                <th style="width: 40px">Action</th>
              </tr>
              <tbody>
                <tr dir-paginate="discount in discounts |filter:searchQry|itemsPerPage: pageSize" current-page="currentPage">
                  <td ng-bind="$index + 1"></td>                 
                  <td ng-bind="discount.category.category_name"></td>
                  <td ng-bind="discount.account_level.level_name"></td>
                   <td ng-bind="discount.cash"></td>
                  <td ng-bind="discount.credit"></td>
                  <td>
                    <a href="#"><i class="fa fa-pencil"></i></a>
                    <a href="#"><i class="fa fa-trash warning"></i></a>
                  </td>
                </tr>
              </tbody>
              
            </table>
          </div>
            <!-- /.box-body -->
          <div class="box-footer clearfix">            
            <dir-pagination-controls boundary-links="true" template-url="../angular/dirPagination.tpl.html"></dir-pagination-controls>
          </div>
        </div>
      </div>
    </section>  
      <!-- /.row (main row) -->
@stop
@section('html_footer')
@parent
<script src="/angular/controllers/supplier.js"></script>
<script src="/angular/dirPagination.js"></script>
<script src="/plugins/select2/select2.full.min.js"></script>
<script type="text/javascript">
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();
  });
</script>
@stop
