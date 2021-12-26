@extends('layouts.app')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-11 col-md-offset-0">
				<div class="panel panel-default">
					<div class="panel-heading">Dashboard</div>
					<div class="panel-body">


						<div class="row">
							<div class="col-md-6">
								<h1>{{ $company }}</h1>
								<p>Last updated {{ $lastsync }}. Package <i>{{ $package['title'] }}</i> with {{ $package['connects'] }} products limit.</p>
							</div>
							<div class="col-md-6">

								<div class="main">
									<div class="top-row row clearfix">
										<div class="action-buttons col-md-12">
											<div class="text-right">
												<a href="{{ route('create-product') }}" class="btn btn-primary">Add Single Product</a> <a href="{{ route('create-batch') }}" class="btn btn-primary">Batch Import</a> <a href="{{ route('categories') }}"
														class="btn btn-primary">Compare Categories</a>
											</div>
										</div>
									</div>
								</div>
							</div>

							@if(Session::has('flash_message'))
								<div class="col-md-12">
								<div class="alert alert-success">
									{{ Session::get('flash_message') }}
								</div>
								</div>
							@endif

						</div>

						<div class="row">
							<div class="col-lg-4">
								<!-- START widget-->
								<div class="panel widget">
									<div class="panel-body">
										<div class="text-right text-muted">
											<em class="fa fa-gamepad fa-2x"></em>
										</div>
										<h3 class="mt0">Tracking Summary</h3>
										<ul>
											<li><span>{{ $counts['products_count'] }}</span> My Products</li>
											<li><span>{{ $counts['products_comp_count'] }}</span> Competitor Products</li>
											<li><span>{{ $counts['products_comp_website'] }}</span> Competitor Websites</li>
											<li><span>{{ $counts['brand_count'] }}</span> Brands</li>
											<li><span>{{ $counts['category_count'] }}</span> Categories</li>


										</ul>

									</div>
								</div>
								<!-- END widget-->
							</div>
							<div class="col-lg-4">
								<!-- START widget-->
								<div class="panel widget">
									<div class="panel-body">
										<div class="text-right text-muted">
											<em class="fa fa-coffee fa-2x"></em>
										</div>
										<h3 class="mt0">Price Changes</h3>
										<ul>
											<li><span>{{ $pricestock['ppinc'] }}</span> Increase in my product prices</li>
											<li><span>{{ $pricestock['ppdec'] }}</span> Decrease in my product prices</li>
											<li><span>{{ $pricestockc['ppinc'] }}</span> Increase in competitor product prices</li>
											<li><span>{{ $pricestockc['ppdec'] }}</span> Decrease in competitor product prices</li>
										</ul>
									</div>
								</div>
								<!-- END widget-->
							</div>
							<div class="col-lg-4">
								<!-- START widget-->
								<div class="panel widget">
									<div class="panel-body">
										<div class="text-right text-muted">
											<em class="fa fa-upload fa-2x"></em>
										</div>
										<h3 class="mt0">Out of Stock</h3>
										<ul>
											<li><a href="{{ route('products-stock') }}"><span>{{ $pricestock['postock'] }}</span> My Products</a></li>
											<li><a href="{{ route('products-stock-comp') }}"><span>{{ $pricestockc['postock'] }}</span> Competitors</a></li>
										</ul>
									</div>
								</div>
								<!-- END widget-->
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<h3 class="mt0">Position</h3>
								<ul>
									<li><span>{{ $avg['avgminus'] }}</span> Im cheaper than average</li>
									<li><span>{{ $avg['avg0'] }}</span> Im average</li>
									<li><span>{{ $avg['avgplus'] }}</span> Im higher than average</li>
								</ul>
							</div>
							<div class="col-md-4 col-md-push-2">
								<div id="canvas-holder">
									<canvas id="chart-area"/>
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
//			jQuery(".show-details-c").click(function () {
//				jQuery(this).closest(".categories").find(".category-details").toggle(1000);
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
//
//			$('.product-delete').on('click', function (e) {
//				e.preventDefault();
//				swal({
//							title: "Are you sure?",
//							text: "You will not be able to recover this imaginary file!",
//							type: "warning",
//							showCancelButton: true,
//							confirmButtonColor: "#DD6B55",
//							confirmButtonText: "Yes, delete it!",
//							closeOnConfirm: false
//						},
//						function () {
//							swal("Deleted!", "Your imaginary file has been deleted.", "success");
//						});
//			});
//
//			$('.product-comp-delete').on('click', function (e) {
//				e.preventDefault();
//				swal({
//							title: "Are you sure?",
//							text: "You will not be able to recover this imaginary file!",
//							type: "warning",
//							showCancelButton: true,
//							confirmButtonColor: "#DD6B55",
//							confirmButtonText: "Yes, delete it!",
//							closeOnConfirm: false
//						},
//						function () {
//							swal("Deleted!", "Your imaginary file has been deleted.", "success");
//						});
//			});
//
//			$('.category-delete').on('click', function (e) {
//				e.preventDefault();
//				swal({
//							title: "Are you sure?",
//							text: "You will not be able to recover this imaginary file!",
//							type: "warning",
//							showCancelButton: true,
//							confirmButtonColor: "#DD6B55",
//							confirmButtonText: "Yes, delete it!",
//							closeOnConfirm: false
//						},
//						function () {
//							swal("Deleted!", "Your imaginary file has been deleted.", "success");
//						});
//			});
//
//			$('.category-comp-delete').on('click', function (e) {
//				e.preventDefault();
//				swal({
//							title: "Are you sure?",
//							text: "You will not be able to recover this imaginary file!",
//							type: "warning",
//							showCancelButton: true,
//							confirmButtonColor: "#DD6B55",
//							confirmButtonText: "Yes, delete it!",
//							closeOnConfirm: false
//						},
//						function () {
//							swal("Deleted!", "Your imaginary file has been deleted.", "success");
//						});
//			});


			var randomScalingFactor = function () {
				return Math.round(Math.random() * 100);
			};

			var config = {
				type: 'pie',
				data: {
					datasets: [{
						data: [
							{{ $avg['avg0'] }},
							{{ $avg['avgplus'] }},
							{{ $avg['avgminus'] }},
						],
						backgroundColor: [
							"#f7941d",
							"#ff0000",
							"#00a651",

						],
						label: 'Dataset 1'
					}],
					labels: [
						"Equal",
						"More",
						"Less"
					]
				},
				options: {
					responsive: true
				}
			};

			window.onload = function () {
				var ctx = document.getElementById("chart-area").getContext("2d");
				window.myPie = new Chart(ctx, config);
			};

		});
	</script>
@endsection