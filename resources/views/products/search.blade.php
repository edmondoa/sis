<div id='product-search'>
	<div class="input-group">	
		<input type="text" class="form-control searchStr">
		<div class="input-group-btn">
		  <button type="button" class="btn btn-primary"><i class='fa fa-search'></i></button>
		</div>
		<!-- /btn-group -->
	</div>
	<br>
	<table class="table table-bordered " id="products" >
		<thead>	
			
			<th>Cat Code</th>
			<th>Product Code</th>
			<th>Product Name</th>
			<th>BarCode</th>
			@if($src == 'stockout' || $src=='transfer')
			<th>Available</th>
			@endif
			<th>Price</th>
		</thead>
		<tbody>		
		</tbody>

	</table>
</div>	