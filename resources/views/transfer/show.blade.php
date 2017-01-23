<section class="invoice">
  <!-- title row -->
  <div class="row">
    <div class="col-xs-12">
      <h2 class="page-header">
        <i class="fa fa-globe"></i> {{$transfer->branch_orig->business_name.", ".$stockout->branch->branch_name}}
        <small class="pull-right">Date: {{$transfer->encode_date}}</small>
      </h2>
    </div>
    <!-- /.col -->
  </div>
  <!-- info row -->
  <div class="row invoice-info">
    
    
    <!-- /.col -->
    <div class="col-sm-4 invoice-col">
    <dl class="dl-horizontal">
      	<dt style="width: 78px">Series # : </dt><dd style="margin-left: 96px">{{$transfer->series_id}}</dd>
        
        <dt style="width: 78px">Status : </dt><dd style="margin-left: 96px">{{$transfer->approval->status}}</dd>
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
        @foreach($transfer->items as $item)
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

</section>
<iframe id="iframe" src=""  style="display:none"/>