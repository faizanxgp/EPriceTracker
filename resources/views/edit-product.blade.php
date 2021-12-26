@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="panel panel-default">
					<div class="panel-heading">Dashboard</div>
					<div class="panel-body">


						<div class="row">
							<div class="col-md-12">
								<div class="main">


									<div class="add-product">
										<h3>Edit Product</h3>
										@if(Session::has('flash_message'))
											<div class="alert alert-success">
												{{ Session::get('flash_message') }}
											</div>
										@endif
										<form method="post" action="{{ route('update-product') }}">
											<div class="form-group">
												<label>Product Name <span class="required">*</span> </label> <input class="form-control" type="text" name="product_title" value="{{ $product->product_title }}" maxlength="150" required/>

											</div>
											<div class="form-group">
												<label>Category</label> <input class="form-control" type="text" name="product_category" value="{{ $product->category }}" maxlength="50" />

											</div>
											<div class="form-group">
												<label>Brand</label> <input class="form-control" type="text" name="product_brand" value="{{ $product->brand }}" maxlength="50" />

											</div>
											<div class="form-group">
												<label>Product URL <span class="required">*</span> </label> <input class="form-control" type="url" name="product_url" value="{{ $product->product_url }}" required/>
											</div>

											<div class="form-group">
												<input type="hidden" name="id" value="{{ $product->id }}"/> <input type="submit" class="btn btn-primary" value="Update Product" name=""/>
												{{ csrf_field() }}

											</div>
										</form>
									</div>
									<hr/>
									<div class="product-details">
										<table class="table table-striped">
											<thead>
											<tr>
												<th>Company</th>
												{{--<th>Price</th>--}}
												{{--<th>Change</th>--}}
												{{--<th>Position</th>--}}
												{{--<th>Stock</th>--}}
												{{--<th>Last Update</th>--}}
												<th></th>
											</tr>
											</thead>
											<tbody>
											@foreach($products as $productd)
												{{--@if ($productd->product_id == $product->id)--}}
												<tr>
													<td>{{ $productd->product_comp->product_url }}</td>
													{{--<td>{{ $productd->product_comp->current_price }}</td>--}}
													{{--<td>Change</td>--}}
													{{--<td>Position</td>--}}
													{{--<td>{{ $productd->product_comp->available }}</td>--}}
													{{--<td>{{ $productd->product_comp->updated_at }}</td>--}}
													<td><a class="product-comp-delete" href="{{ route('product-comp-delete', $productd->id) }}"><i class="fa fa-trash"></i></a></td>
												</tr>
												{{--@endif--}}
											@endforeach
											</tbody>
										</table>
										{{--<div class="add-more">--}}
										{{--<hr />--}}
										{{--<form method="post" action="{{ route('add-product-comp') }}">--}}
										{{--<input type="url" class="form-control" style="width: 420px; display: inline" name="competitor" value="" placeholder="URL" />--}}
										{{--<input type="hidden" name="id" value="{{ $productu->product_id }}" />--}}
										{{--{{ csrf_field() }}--}}
										{{--<input type="submit" class="btn btn-primary" value="Add Competitor" />--}}

										<div class="add-more">
<hr />
											<form method="post" action="{{ route('add-product-comp') }}">
												<input type="url" class="form-control" style="width: 420px; display: inline" name="competitor" value="" placeholder="URL"/> <input type="hidden" name="id" value="{{ $product->id }}"/>
												{{ csrf_field() }}
												<input type="submit" class="btn btn-primary" value="Add Competitor"/>
											</form>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


@endsection

@section('js')

	<script>
		jQuery(document).ready(function () {
			console.log("ready!");

			$('.product-comp-delete').click(function (e) {
				e.preventDefault(); // Prevent the href from redirecting directly
				var linkURL = $(this).attr("href");
				warnBeforeRedirect2(linkURL);
			});

			function warnBeforeRedirect2(linkURL) {
				swal({
					title: "Are you sure?",
					text: "You will not be able to recover this imaginary file!",
					type: "warning",
					showCancelButton: true,
					confirmButtonColor: "#DD6B55",
					confirmButtonText: "Yes, delete it!",
					closeOnConfirm: false
//					title: "Leave this site?",
//					text: "If you click 'OK', you will be redirected to " + linkURL,
//					type: "warning",
//					showCancelButton: true
				}, function () {
					// Redirect the user
					window.location.href = linkURL;
				});
			}

//			jQuery(".show-details").click(function () {
//				jQuery(this).closest(".products").find(".product-details").toggle(1000);
//			});

//			jQuery(".add-competitor").click(function (e) {
//				e.preventDefault();
//				jQuery(".competitor").append('<div class="competitor-url form-group"><label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL"/></div>');
//			});
//
//			jQuery(".add-competitor-category").click(function (e) {
//				e.preventDefault();
//				jQuery(".competitor-category").append('<div class="competitor-url form-group"><label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL"/></div>');
//			});


		});
	</script>
@endsection