<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>STOCKIN</title>
    <style>
      body * { font-family:arial; }
      body #header { width:100%; }
      body #lineitems { width:100%; }
      body > table { width:100%; }
      body > table th { text-align:left; }
      body table .border{ border: 1px solid #aaa}
    </style>
  </head>
<body class="hold-transition skin-blue sidebar-mini " >
<div class="wrapper">
  <div class="content-wrapper row">
    <!-- Content Header (Page header) -->
    <section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> {{$stockin->branch->business_name.", ".$stockin->branch->branch_name}}
        <small class="pull-right">Date: {{$stockin->encode_date}}</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-8 invoice-col">
      FROM
      <address>
      <dl class="dl-horizontal">
        <dt style="width: 78px">Supplier : </dt><dd style="margin-left: 96px">{{$stockin->supplier->supplier_name}}</dd>
        <dt style="width: 78px">Contact  : </dt><dd style="margin-left: 96px">{{$stockin->supplier->contact_person}}</dd>
        <dt style="width: 78px">Mobile   : </dt><dd style="margin-left: 96px">{{$stockin->supplier->mobile1_no}}</dd>
        <dt style="width: 78px">Landline : </dt><dd style="margin-left: 96px">{{$stockin->supplier->landline}}</dd>
        <dt style="width: 78px">Email    : </dt><dd style="margin-left: 96px">{{$stockin->supplier->email}}</dd>
      </dl>
       
      </address>
    </div>
    
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
    <dl class="dl-horizontal">
        <dt style="width: 78px">Series # : </dt><dd style="margin-left: 96px">{{$stockin->series_id}}</dd>
        <dt style="width: 78px">Doc #  : </dt><dd style="margin-left: 96px">{{$stockin->doc_no}}</dd>
        <dt style="width: 78px">Doc Date   : </dt><dd style="margin-left: 96px">{{$stockin->doc_date}}</dd>
        <dt style="width: 78px">Status : </dt><dd style="margin-left: 96px">{{$stockin->approval->status}}</dd>
    </dl>     
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  <!-- Table row -->
  <div class="row">
    <div class="col-xs-12 table-responsive" style="height: 400px; overflow-y: auto;">
      <table class="table table-striped">
        <thead>
        <tr>
          <th class='col-sm-2'>Prod Code</th>
          <th class='col-sm-2'>Cat Code</th>
          <th>Product</th>
          <th class='col-sm-1'>Price</th>
          <th class='col-sm-1'>Qty</th>
          <th class='col-sm-1'>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php 
          $quantity = 0;
          $total = 0;
        ?>
        @foreach($stockin->items as $item)
        <tr>
          <td>{{$item->product->product_code}}</td>
          <td>{{$item->product->category->category_code}}</td>
          <td>{{$item->product->product_name}}</td>
          <td>{{$item->cost_price}}</td>
          <td>{{$item->quantity}}</td>
          <td>{{ number_format(($item->quantity * $item->cost_price), 2, '.', ',')}}</td>
        </tr>
        <?php $quantity += $item->quantity; $total += ($item->quantity * $item->cost_price)?>
        @endforeach
        </tbody>
        <tfoot>
          <td> </td>
          <td> </td>
          <td> </td>
          <td><strong>Total</strong></td>
          <td><strong>{{$quantity}}</strong></td>
          <td><strong>{{ number_format($total,2,'.',',')}}</strong></td>
          
        </tfoot>
      </table>
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->

  
  <!-- /.row -->

  <!-- this row will not appear when printing -->
 
</section>
    <!-- /.content -->
   </div> 
</div>

</body>
</html>
