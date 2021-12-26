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

									<div class="add-category">
										<h3>Add Catgory</h3>
										<form method="post" action="{{ route('add-category') }}">
											<div class="form-group">
												<label>Category Name <span class="required">*</span> </label> <input class="form-control" type="text" name="category_title" required />

											</div>
											<div class="form-group">
												<label>Catgory URL <span class="required">*</span> </label> <input class="form-control" type="url" name="category_url" required />
											</div>
											<div class="competitor-category">
												<hr/>
												<div class="mb10 clearfix">
													<button class="btn btn-primary pull-right add-competitor-category">Add Competitor</button>
												</div>
												<div class="competitor-url form-group">
													<label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL"/>
												</div>
												<div class="empty"></div>
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-primary" value="Add Category" name=""/>
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


			jQuery(".show-details").click(function () {
				jQuery(this).closest(".products").find(".product-details").toggle(1000);
			});

			jQuery(".add-competitor").click(function (e) {
				e.preventDefault();
				jQuery(".competitor").append('<div class="competitor-url form-group"><label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL"/></div>');
			});

			jQuery(".add-competitor-category").click(function (e) {
				e.preventDefault();
				jQuery(".competitor-category").append('<div class="competitor-url form-group"><label>Competitor URL</label> <input class="form-control" type="url" name="competitor_url[]" placeholder="URL"/></div>');
			});


		});
	</script>
@endsection