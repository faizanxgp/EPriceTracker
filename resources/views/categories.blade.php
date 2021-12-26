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
									{{--<div class="top-row row clearfix">--}}
										{{--<div class="search col-md-6">--}}
											{{--<form>--}}
												{{--<input type="text" class="form-control" placeholder="Product Title"/>--}}
											{{--</form>--}}
										{{--</div>--}}
										{{--<div class="action-buttons col-md-6">--}}
											{{--<div class="text-right">--}}
												{{--<a href="{{ route('create-product') }}" class="btn btn-primary">Add Single Product</a> <a href="{{ route('create-batch') }}" class="btn btn-primary">Batch Import</a> <a href="{{ route('create-category') }}" class="btn btn-primary">Compare Categories</a>--}}
											{{--</div>--}}
										{{--</div>--}}
									{{--</div>--}}
									<h3>Categories will be back with you soon</h3>


												{{--<h3>Categories</h3>--}}

												{{--@foreach($categoriesbyuser as $categoryu)--}}
													{{--<div class="categories">--}}
														{{--<div class="category-row">--}}
															{{--<div class="category-title">--}}
																{{--<h3>{{ $categoryu->category->category }}</h3>--}}
															{{--</div>--}}
															{{--<div class="action-product pull-right">--}}
																{{--<a href="{{ route('edit-category', $categoryu->category_id) }}" class="btn btn-primary"><i class="fa fa-pencil"></i></a> <a href="{{ route('delete-category', $categoryu->category_id) }}" class="btn btn-primary category-delete"><i class="fa fa-trash"></i></a>--}}
																{{--<button class="btn btn-primary show-details-c"><strong>+</strong></button>--}}
															{{--</div>--}}
														{{--</div>--}}
														{{--<div class="category-details" style="display: none;">--}}
															{{--<table class="table table-striped">--}}
																{{--<thead>--}}
																{{--<tr>--}}
																	{{--<th>Category</th>--}}
																	{{--<th>Category URL</th>--}}
																	{{--<th>Last Update</th>--}}
																	{{--<th></th>--}}
																{{--</tr>--}}
																{{--</thead>--}}
																{{--<tbody>--}}
																{{--@foreach($categories as $category)--}}
																	{{--@if ($category->category_id == $categoryu->category_id)--}}
																		{{--<tr>--}}
																			{{--<td>{{ $category->categorycomp->category }}</td>--}}
																			{{--<td>{{ $category->categorycomp->category_url }}</td>--}}
																			{{--<td><a class="category-comp-delete" href="{{ route('category-comp-delete', $category->id) }}"><i class="fa fa-trash"></i></a></td>--}}
																		{{--</tr>--}}
																	{{--@endif--}}
																{{--@endforeach--}}
																{{--</tbody>--}}
															{{--</table>--}}
															{{----}}
														{{--</div>--}}
													{{--</div>--}}
												{{--@endforeach--}}


									<hr>





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


			jQuery(".show-details").click(function () {
				jQuery(this).closest(".products").find(".product-details").toggle(1000);
			});

			jQuery(".show-details-c").click(function () {
				jQuery(this).closest(".categories").find(".category-details").toggle(1000);
			});

			jQuery(".add-competitor").click(function (e) {
				e.preventDefault();
				jQuery(".competitor").append('<div class="competitor-url form-group"><label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL"/></div>');
			});

			jQuery(".add-competitor-category").click(function (e) {
				e.preventDefault();
				jQuery(".competitor-category").append('<div class="competitor-url form-group"><label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL"/></div>');
			});

			$('.product-delete').on('click', function (e) {
				e.preventDefault();
				swal({
							title: "Are you sure?",
							text: "You will not be able to recover this imaginary file!",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Yes, delete it!",
							closeOnConfirm: false
						},
						function () {
							swal("Deleted!", "Your imaginary file has been deleted.", "success");
						});
			});

			$('.product-comp-delete').on('click', function (e) {
				e.preventDefault();
				swal({
							title: "Are you sure?",
							text: "You will not be able to recover this imaginary file!",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Yes, delete it!",
							closeOnConfirm: false
						},
						function () {
							swal("Deleted!", "Your imaginary file has been deleted.", "success");
						});
			});

			$('.category-delete').on('click', function (e) {
				e.preventDefault();
				swal({
							title: "Are you sure?",
							text: "You will not be able to recover this imaginary file!",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Yes, delete it!",
							closeOnConfirm: false
						},
						function () {
							swal("Deleted!", "Your imaginary file has been deleted.", "success");
						});
			});

			$('.category-comp-delete').on('click', function (e) {
				e.preventDefault();
				swal({
							title: "Are you sure?",
							text: "You will not be able to recover this imaginary file!",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Yes, delete it!",
							closeOnConfirm: false
						},
						function () {
							swal("Deleted!", "Your imaginary file has been deleted.", "success");
						});
			});

		});
	</script>
@endsection