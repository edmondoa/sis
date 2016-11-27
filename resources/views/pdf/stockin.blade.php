<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>STOCKIN</title>
    <style type="text/css">
      body{font-size: 11px}
      .list {
        border-collapse: collapse;
      }

      .list th, .list td {
          border: 1px solid black;
      }
      .no-border{border-left:0px !important; border-right:0px !important }
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
          <table style="width:1200px">
            <tr>
              <td style='width:50%'><h4>{{$stockin->branch->business_name.", ".$stockin->branch->branch_name}}</h4></td>
              <td style='width:50%'>Date: {{$stockin->encode_date}}</td>
            </tr>
          </table>
        </div>
        <!-- /.col -->
      </div> 
      <table style='width:1200px'>
        <tr>
          <td >FROM</td>
          <td style='width:50%'><span>Series # : </span><span >{{$stockin->series_id}}</span></td>
        </tr>
        <tr>
          <td><span >Supplier : </span><span >{{$stockin->supplier->supplier_name}}</span></td>
          <td><span >Doc #  : </span><span >{{$stockin->doc_no}}</span></td>
        </tr>
        <tr>
          <td></td>
          <td><span >Doc Date   : </span><span >{{$stockin->doc_date}}</span>
            </td>
        </tr>
        <tr>
          <td></td>
          <td><span >Status : </span><span >{{$stockin->approval->status}}</span></td>
        </tr>
        <tr>
          <td></td>
          <td><span >Arrive Date : </span><span>{{$stockin->arrive_date}}</span></td>
        </tr>
      </table>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive" >
          <table class="list" style='width:700px; margin-top:10px'>
          
            <tr>
              <th  style="text-align:left">Prod Code</th>
              <th  style="text-align:left">Cat Code</th>
              <th  style="text-align:left">Product</th>
              <th  style="text-align:left">Price</th>
              <th  style="text-align:left">Qty</th>
              <th  style="text-align:left">Total</th>
            </tr>
           
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
              <td class='no-border'> </td>
              <td class='no-border'> </td>
              <td class='no-border'> </td>
              <td class='no-border'><strong>Total</strong></td>
              <td class='no-border'><strong>{{$quantity}}</strong></td>
              <td class='no-border'><strong>{{ number_format($total,2,'.',',')}}</strong></td>
              
            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>

 
    </section>
    <!-- /.content -->
   </div> 
   <div style="position: relative">
      <table style="position: fixed; bottom: 10; width:100%;">
        <tr>
          <td><span style="text-decoration:overline">&nbsp;&nbsp;&nbsp;Print Name / Signature&nbsp;&nbsp;</span></td>
          <td><span style="text-decoration:overline">&nbsp;&nbsp;&nbsp;Print Name / Signature&nbsp;&nbsp;</span></td>
          
        </tr>
      </table>
        
    </div>
</div>

</body>
</html>
