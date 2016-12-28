<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>STOCKOUT</title>
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
       
      <table style='width:1200px;  border-spacing: 10px 0; '>
        <tr>
          <td >Domain : <span>{{$stockout->branch->branch_name}}</span></td>
          <td style='width:50%'><span>Status : </span><span >{{$stockout->approval->status}}</span></td>
        </tr>
        <tr>
          <td >Branch</td>
          <td style='width:50%'><span>Stockout ID : </span><span >{{$stockout->stockout_id}}</span></td>
        </tr> 
        <tr>          
          <td><span >Encode Date : </span><span>{{$stockout->encode_date}}</span> </td>
          <td><span >PostDate : </span><span >{{$stockout->post_date}}</span></td>
        </tr>
        
        <tr>          
          <td><span >User: </span><span>{{$stockout->user->username}}</span></td>
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
              <th  style="text-align:left; width:75px !important">Price</th>
              <th  style="text-align:left; width:50px !important">Qty</th>
              <th  style="text-align:left; width:75px !important">Amount</th>
            </tr>
           
            <tbody>
            <?php 
              $quantity = 0;
              $total = 0;
            ?>
            @foreach($stockout->items as $item)
            <tr>
              <td>{{$item->product->category->category_code}}</td>
              <td>{{$item->product->product_code}}</td>              
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
