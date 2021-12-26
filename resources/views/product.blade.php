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
										<h3>Add Product</h3>
										@if(Session::has('flash_message'))
											<div class="alert alert-success">
												{{ Session::get('flash_message') }}
											</div>
										@endif
										<form method="post" action="{{ route('add-product') }}">
											<div class="form-group">
												<label>Product Name <span class="required">*</span> </label> <input class="form-control" type="text" name="product_title" maxlength="150" required />

											</div>
											<div class="form-group">
												<label>Category</label> <input class="form-control" type="text" name="product_category" maxlength="50" />

											</div>
											<div class="form-group">
												<label>Brand</label> <input class="form-control" type="text" name="product_brand" maxlength="50" />

											</div>
											<div class="form-group">
												<label>Product URL <span class="required">*</span> </label> <input class="form-control" type="url" name="product_url" required />
											</div>
											<div class="competitor">
												<hr/>
												{{--<div class="mb10 clearfix">--}}
													{{--<button class="btn btn-primary pull-right add-competitor">Add Competitor</button>--}}
												{{--</div>--}}
												<div class="competitor-url form-group">
													<label>Competitor URL <span class="required">*</span> </label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL" required />
												</div>
												<div class="competitor-url form-group">
													<label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL" />
												</div>
												<div class="competitor-url form-group">
													<label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL" />
												</div>
												<div class="competitor-url form-group">
													<label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL" />
												</div>
												<div class="empty"></div>
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-primary" name="submitBtn" value="Submit" name=""/>
												<input type="submit" class="btn btn-primary" name="submitBtn" value="Submit and Add Another" name=""/>
												{{ csrf_field() }}

											</div>


										</form>


									</div>


									<hr/>


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


//			jQuery(".show-details").click(function () {
//				jQuery(this).closest(".products").find(".product-details").toggle(1000);
//			});
//
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