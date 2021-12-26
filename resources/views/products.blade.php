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
									<div class="top-row row clearfix">
										<div class="search col-md-6">
											<form method="get" action="{{ route('products') }}">
												<input name="str" type="text" class="form-control" placeholder="Product Title"/>
											</form>
										</div>
										<div class="action-buttons col-md-6">
											<div class="text-right">
												<a href="{{ route('create-product') }}" class="btn btn-primary">Add Single Product</a> <a href="{{ route('create-batch') }}" class="btn btn-primary">Batch Import</a> <a href="{{ route('categories') }}"
														class="btn btn-primary">Compare Categories</a>
											</div>
										</div>
									</div>


									<h3>Products</h3>

									@foreach($productsbyuser as $productu)
										<div class="products">
											<div class="product-row row">
												<div class="product-title col-md-9">
													<h4 class="show-details">{{ $productu->product->product_title }}</h4>
												</div>
												<div class="action-product col-md-3 pull-right">
													<?php $avg = $productu->product->isAvg($user_id); ?>
													@if ($avg == 0)
															<img src="{{ URL::to('img/orange_icon.png') }}" alt=""
															class="img-responsive">
													@elseif ($avg == 1) <img src="{{ URL::to('img/red_icon.png') }}" alt="" class="img-responsive">
													@else <img src="{{ URL::to('img/green_icon.png') }}" alt=""
															class="img-responsive">
													@endif
													<a href="{{ route('edit-product', $productu->product_id) }}" class="btn btn-primary" title="Edit"><i class="fa fa-pencil"></i></a> <a href="{{ route('delete-product', $productu->product_id) }}"
															class="btn btn-primary product-delete" title="Delete"><i class="fa fa-trash"></i></a> <a href="{{ route('product-history', $productu->product_id) }}" class="btn btn-primary ls-modal showChart" style="display: none;" title="Chart"><i
																class="fa fa-line-chart"></i></a>
													<button class="btn btn-primary show-details" title="Show Details"><strong><i class="fa fa-plus"></i> </strong></button>
												</div>
											</div>
											<div class="product-details" style="display: none;">
												<table class="table table-striped">
													<thead>
													<tr>
														<th>Company</th>
														<th>Price</th>
														<th>Change</th>
														<th>Position</th>
														<th>Stock</th>
														<th>Last Update</th>
														<th></th>
													</tr>
													</thead>
													<tbody>


													{{--{{ $productu->product_user->related_products() }}--}}
													{{--{{ $productu->product_user->xxx() }}--}}
													<?php $positions = $productu->product->position($user_id); ?>
													<?php $change = $productu->product->product_history_change(); $price = $productu->product->current_price;  ?>
													<tr>
														<td><strong>{{ $productu->product->getCompany() }}</strong> <i class="fa fa-flag"></i> </td>
														<td>@if($price==0) -- @else {{ number_format($productu->product->current_price, 0, '.', ',') }}@endif</td>
														<td>@if ($price == 0) -- @else @if ($change > 0) <i class="fa fa-arrow-up"></i> {{ number_format($change, 0, '.', ',') }}  @elseif ($change < 0) <i class="fa fa-arrow-down"></i> {{ number_format($change, 0, '.', ',') }}  @elseif ($change == 0)  @else - @endif @endif </td>
														<td>@if ($price == 0) -- @else <?php
															$rank = 1; $old = $productu->product->current_price;
															foreach ($positions as $k=>$p) {
																if ($k == $productu->product->id) {
																	echo $rank;
																	break;
																}
																if ($old <> $p) {
																	$old = $p;
																	$rank++;
																}
															}
															?>@endif</td>
														<td>@if ($price == 0) -- @elseif($productu->product->available == 1) <i class="fa fa-check"></i> @else <i class="fa fa-times"></i> @endif</td>
														<td>@if ($price == 0) Awaiting update @else {{ $productu->product->updated_at }}@endif</td>
														<td>My Product</td>
													</tr>
													<?php $products = $productu->product->related_products($user_id); ?>
													@foreach($products as $product_1)
														{{--@if ($product->product_id == $productu->product_id)--}}
														<?php $change = $product_1->product_comp->product_history_change(); $price = $product_1->product_comp->current_price; ?>
														<tr>
															<td>{{ $product_1->product_comp->getCompany() }}</td>
															<td>@if($price == 0) -- @else {{ number_format($product_1->product_comp->current_price, 0, '.', ',') }}@endif</td>
															<td>
																@if ($price == 0) -- @else
																	@if ($change > 0)
																		<i class="fa fa-arrow-up"></i> {{ number_format($change, 0, '.', ',') }}
																	@elseif  ($change < 0)
																		<i class="fa fa-arrow-down"></i> {{ number_format($change, 0, '.', ',') }}
																	@elseif ($change == 0)
0
																	@else
																		-
																	@endif

																@endif</td>
															<td>@if ($price == 0) -- @else
															<?php
																	$rank = 1; $old = $product_1->product_comp->current_price;
																	foreach ($positions as $k=>$p) {
																		if ($k == $product_1->product_comp->id) {
																			echo $rank;
																			break;
																		}
																		if ($old <> $p) {
																			$old = $p;
																			$rank++;
																		}

																		//echo 'a';echo $k; echo ' '; echo $p; echo 'b';
																	}
															?> @endif
															</td>
															<td>@if ($price == 0) -- @elseif($product_1->product_comp->available == 1) <i class="fa fa-check"></i> @else <i class="fa fa-times"></i> @endif</td>
															<td>@if ($price == 0) Awaiting update @else {{ $product_1->product_comp->updated_at }}@endif</td>
															<td><a class="product-comp-delete" href="{{ route('product-comp-delete', $product_1->id) }}"><i class="fa fa-trash"></i></a></td>
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
												{{--</form>--}}
												{{--</div>--}}
											</div>

										</div>
									@endforeach
									{{-- $productsbyuser->links() --}}
									Page:
									@for ($i = 0; $i < $pages; $i++)
										<a href="{{ route('products') }}?page={{ $i+1 }}">{{ $i+1 }}</a>&nbsp;
									@endfor
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

			jQuery(".showChart").show();

			jQuery(".show-details").click(function () {
				jQuery(this).closest(".products").find(".product-details").toggle(1000);
			});

			jQuery(".show-details-c").click(function () {
				jQuery(this).closest(".categories").find(".category-details").toggle(1000);
			});

//			jQuery(".add-competitor").click(function (e) {
//				e.preventDefault();
//				jQuery(".competitor").append('<div class="competitor-url form-group"><label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL"/></div>');
//			});
//
//			jQuery(".add-competitor-category").click(function (e) {
//				e.preventDefault();
//				jQuery(".competitor-category").append('<div class="competitor-url form-group"><label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL"/></div>');
//			});


			$('.product-delete').click(function (e) {
				e.preventDefault(); // Prevent the href from redirecting directly
				var linkURL = $(this).attr("href");
				warnBeforeRedirect(linkURL);
			});

			function warnBeforeRedirect(linkURL) {
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

			jQuery('.ls-modal').on('click', function (e) {
				e.preventDefault();
				jQuery('#myModal').modal({backdrop: false}).find('.modal-body').load(jQuery(this).attr('href'));
				//$('.modal-backdrop').hide();

			});

//			jQuery('.ls-modal').on('click', function (e) {
//				e.preventDefault();
//				jQuery('#myModal').modal('show').find('.modal-body').load(jQuery(this).attr('href'));
//			});

//			$('.ls-modal').on('click', function(e){
//				e.preventDefault();
//				$('#myModal').modal('show').find('.modal-body').load($(this).attr('href'));
//			});

		});
	</script>
@endsection