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


									<div class="add-batch">
										<h3>Import Batch</h3>
										<form method="post" action="{{ route('add-batch') }}" enctype="multipart/form-data">
											<div class="form-group">
												<label>Import File</label> <input class="form-control" type="file" name="csvfile"/>
												<p>File must be .CSV and in <a href="{{ URL::to('downloads/EPT-Template.csv') }}">provided format</a>.</p>
											</div>
											<div class="form-group">
												<input type="submit" class="btn btn-primary" value="Import Batch" name=""/>
												{{ csrf_field() }}

											</div>


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
				jQuery(".competitor").append('<div class="competitor-url form-group"><label>Competitor URL</label> <input class="form-control" type="text" name="competitor_url[]" placeholder="URL"/></div>');
			});

			jQuery(".add-competitor-category").click(function (e) {
				e.preventDefault();
				jQuery(".competitor-category").append('<div class="competitor-url form-group"><label>Competitor URL</label> <input class="form-control" type="text" name="competitor_url[]" placeholder="URL"/></div>');
			});


		});
	</script>
@endsection