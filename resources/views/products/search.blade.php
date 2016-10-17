<table class="table table-bordered">
	<thead>
		<th><input type='checkbox' class='all'/></th>
		<th>Product Code</th>
		<th>Product Name</th>
		<th>Price</th>
	</thead>
	@if(!empty($products))
		@foreach($products as $prod)
		<tr>
			<td><input type='checkbox' class='selected' data-id='{{$prod->product_id}}'/></td>	
			<td>{{$prod->product_code}}</td>
			<td>{{$prod->product_name}}</td>
			<td>{{$prod->cost_price}}</td>
		</tr>
		@endforeach
	@else
		<tr>
			<td colspan="3">No found products</td>
			
		</tr>
	@endif	
</table>