@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-11 col-md-offset-0">
				<div class="panel panel-default">
					<div class="panel-heading">Dashboard</div>
					<div class="panel-body">


						<div class="row">
							<div class="col-md-12">
								<div class="main">



									<h3>Out of Stock Products - Competitors</h3>
									<table class="table">
									@foreach($products as $product)
										<tr>
											<td>{{ $product->getCompany() }} <a href="{{ $product->product_url }}">link</a></td>
											<td>{{ $product->current_price}}</td>
											<td>@if($product->available == 1) Yes @else No @endif</td>
										</tr>
									@endforeach
</table>

									<hr>


								</div>


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>



</div>


	<div id="myModal" class="modal" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Price History</h4>
				</div>
				<div class="modal-body">
					<p></p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
@endsection

@section('js')

	<script>
		jQuery(document).ready(function () {
			//console.log("ready!");


		});
	</script>
@endsection