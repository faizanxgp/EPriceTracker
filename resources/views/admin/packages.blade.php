@extends('layouts.admin')

@section('title')
	Admin Dashboard
@endsection

@section('pageHeading')
	User Dashboard
@endsection

@section('content')
	<section id="page" class="header-margin">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2><i class="fa fa-envelope"></i> Packages </h2>
				</div>
				<div class="col-md-12">
					{{--<h3 class="inline"><i class="fa fa-list-ul"></i> Activities </h3>--}}
					{{--<div class="filterby">Filter by <select></select></div>--}}

					<table class="table">
						<tr>
							<th>Package</th>
							<th>Price</th>
							<th>Connects</th>
							<th>Date/Time</th>
							<th>Action</th>
						</tr>
						@foreach($packages as $package)
							<tr>
								<td><a href="{{ route('admin.package', $package->id) }}">{{ $package->package }}</a></td>
								<td>{{ $package->price }}</td>
								<td>{{ $package->connects }}</td>
								<td>{{ $package->created_at }}</td>
								<td><a class="btn btn-primary" href="{{ route('admin.package', $package->id) }}">Edit</a> <a class="btn btn-danger" href="">Delete</a></td>

							</tr>
						@endforeach
						<tr><td colspan="7">{{ $packages->links() }}</td></tr>
					</table>
					<p><a class="btn btn-primary" href="{{ route('admin.package') }}">Add Package</a></p>
				</div>

			</div>
		</div>


	</section>

@endsection