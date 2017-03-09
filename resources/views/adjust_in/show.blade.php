<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> {{$adjustin->branch->business_name.", ".$adjustin->branch->branch_name}}
        <small class="pull-right">Date: {{$adjustin->encode_date}}</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    <div class="col-sm-8 invoice-col" >
      <dl class="dl-horizontal">
      	<dt style="width: 78px">Domain : </dt><dd style="margin-left: 96px">{{$adjustin->branch->branch_name}}</dd>
        <dt style="width: 88px">Status : </dt><dd style="margin-left: 96px">{{$adjustin->approval->status}}</dd>
        <dt style="width: 88px">AdjustIn ID : </dt><dd style="margin-left: 96px">{{$adjustin->stock_adj_in_id}}</dd>

      </dl>


    </div>

    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
    <dl class="dl-horizontal">
        <dt style="width: 88px">Series # : </dt><dd style="margin-left: 96px">{{$adjustin->series_id}}</dd>
        <dt style="width: 88px">Post Date  : </dt><dd style="margin-left: 96px">{{$adjustin->approval->post_date}}</dd>
        <dt style="width: 88px">Encode Date   : </dt><dd style="margin-left: 96px">{{$adjustin->encode_date}}</dd>
        <dt style="width: 88px">User  : </dt><dd style="margin-left: 96px">{{$adjustin->user->username}}</dd>
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
          <th class='col-sm-1 text-right'>Price</th>
          <th class='col-sm-1 text-right'>Qty</th>
          <th class='col-sm-1 text-right'>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php
        	$quantity = 0;
        	$total = 0;
        ?>
        @foreach($adjustin->items as $item)
        <tr>
          <td>{{$item->product->product_code}}</td>
          <td>{{$item->product->category->category_code}}</td>
          <td>{{$item->product->product_name}}</td>
          <td class='text-right'>{{$item->cost_price}}</td>
          <td class='text-right'>{{$item->quantity}}</td>
          <td class='text-right'>{{ number_format(($item->quantity * $item->cost_price), 2, '.', ',')}}</td>
        </tr>
        <?php $quantity += $item->quantity; $total += ($item->quantity * $item->cost_price)?>
        @endforeach
        </tbody>
        <tfoot>
        	<td> </td>
        	<td> </td>
        	<td> </td>
        	<td><strong>Total</strong></td>
        	<td class='text-right'><strong>{{$quantity}}</strong></td>
        	<td class='text-right'><strong>₧{{ number_format($total,2,'.',',')}}</strong></td>

        </tfoot>
      </table>
    </div>
    <!-- /.col -->
  </div>

</section>
<iframe id="iframe" src=""  style="display:none"/>
