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
					<h2><i class="fa fa-envelope"></i> Users </h2>
				</div>
				<div class="col-md-12">
					{{--<h3 class="inline"><i class="fa fa-list-ul"></i> Activities </h3>--}}
					{{--<div class="filterby">Filter by <select></select></div>--}}

					<table class="table">
						<tr>
							<th>Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Website</th>
							<th>Verified</th>
							<th>Package</th>
							<th>Validity</th>
							<th>Signed up</th>
							<th>Action</th>
						</tr>
						@foreach($users as $user)
							<tr>
								<td><a href="{{ route('admin.user', $user->id) }}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->phone }}</td>
								<td>{{ $user->website }}</td>
								<td>@if ($user->verified == 1) Yes @else No @endif</td>
								<td><?php $p = $user->user_package(); ?> {{ $p['title'] }}</td>
<td>{{ $p['uptodate'] }}</td>
								<td>{{ $user->created_at }}</td>
								<td><a class="btn btn-primary" target="_blank" href="{{ route('admin.login-user', $user->id) }}">Login as USER</a> <a class="btn btn-primary" href="{{ route('admin.user', $user->id) }}">Package</a> <a class="btn btn-danger"
											href="{{ route ('admin.suspend-user', $user->id) }}"> @if($user->verified == 1) Suspend @else Activate @endif</a></td>

							</tr>
						@endforeach
						<tr><td colspan="7">{{ $users->links() }}</td></tr>
					</table>

				</div>

			</div>
		</div>


	</section>

@endsection