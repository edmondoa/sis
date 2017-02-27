<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>STOCKIN</title>
    <style type="text/css">
      body{font-size: 11px}
      .list {
        border-collapse: collapse;
         border-spacing: 0 1em;
      }

      .list th,  {
          border-top: 2px solid black;
          border-bottom: 2px solid black;
      }
      .list th:last-child{
        border-right: 2px solid black;
       }
      .list th:first-child{
        border-left: 2px solid black;

      }

      .list tr:last-child td{ border-bottom: 2px solid black};
}
      .no-border{border-left:0px !important; border-right:0px !important }
    </style>

  </head>
<body class="hold-transition skin-blue sidebar-mini " >
<div class="wrapper">
  <div class="content-wrapper row">
    <!-- Content Header (Page header) -->
    <section class="invoice">
      <?php      
        setlocale(LC_MONETARY, 'en_PH');
      ?>
      <table style='width:1200px;  border-spacing: 10px 0; '>
        <tr>
          <td >Domain : <span>{{Session::get('dbname')}}</span></td>
          <td style='width:50%'><span>Status : </span><span >{{$stockin->approval->status}}</span></td>
        </tr>
        <tr>
          <td >Branch : <span>{{$stockin->branch->branch_name}}</span></td>
          <td style='width:50%'><span>Stockin ID : </span><span >{{$stockin->stockin_id}}</span></td>
        </tr>
        <tr>
          <td><span >Supplier : </span><span >{{$stockin->supplier->supplier_name}}</span></td>
          <td><span >Series ID  : </span><span >{{$stockin->series_id}}</span></td>
        </tr>
        <tr>
          <td><span >Doc #  : </span><span >{{$stockin->doc_no}}</span></td>
          <td><span >PostDate : </span><span >{{$stockin->post_date}}</span></td>
        </tr>
        <tr>
          <td><span >Doc Date   : </span><span >{{$stockin->doc_date}}</span></td>
          <td><span >Encode Date : </span><span>{{$stockin->encode_date}}</span> </td>
        </tr>

        <tr>
          <td><span >Arrive Date : </span><span>{{$stockin->arrive_date}}</span> </td>
          <td><span >User: </span><span>{{$stockin->user->username}}</span></td>
        </tr>
      </table>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive" >
          <table class="list" style='width:700px; margin-top:50px'>

            <tr>
              <th  style="text-align:left; width:75px !important">Cat</th>
              <th  style="text-align:left;width:100px !important">ProductCode</th>
              <th  style="text-align:left">ProductName</th>
              <th  style="text-align:right; width:75px !important">Price</th>
              <th  style="text-align:right; width:50px !important">Qty</th>
              <th  style="text-align:right; width:75px !important">Amount</th>
            </tr>

            <tbody>
            <?php
              $quantity = 0;
              $total = 0;
            ?>
            @foreach($stockin->items as $item)
            <tr>
              <td>{{$item->product->category->category_code}}</td>
              <td>{{$item->product->product_code}}</td>
              <td>{{$item->product->product_name}}</td>
              <td style="text-align:right; !important">{{$item->cost_price}}</td>
              <td style="text-align:right;  !important">{{$item->quantity}}</td>
              <td style="text-align:right; !important">{{ number_format(($item->quantity * $item->cost_price), 2, '.', ',')}}</td>
            </tr>
            <?php $quantity += $item->quantity; $total += ($item->quantity * $item->cost_price)?>
            @endforeach
            </tbody>
            <tfoot>
              <td class='no-border'> </td>
              <td class='no-border'> </td>
              <td class='no-border'> </td>
              <td style="text-align:right; !important" class='no-border text-right'><strong>Total</strong></td>
              <td style="text-align:right; !important" class='no-border text-right'><strong>{{$quantity}}</strong></td>
              <td style="text-align:right; !important" class='no-border text-right'><strong>{{money_format('%i', $total)}}  </strong></td>

            </tfoot>
          </table>
        </div>
        <!-- /.col -->
      </div>


    </section>
    <!-- /.content -->
   </div>
   <div style="position: relative; margin-top:50px;">
      <span >Checked By :<span style='text-decoration:underline;width:200px'>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      </span> </span>
    </div>
</div>

</body>
</html>
