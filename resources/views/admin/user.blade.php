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
				<div class="col-md-6 col-md-push-3">
					@if(Session::has('flash_message'))
						<div class="alert alert-success">
							{{ Session::get('flash_message') }}
						</div>
					@endif
					<h2><i class="fa fa-gift"></i> Package History - {{ $user->first_name }} {{ $user->last_name }}</h2>
						<table class="table table-stripped">
							<tr>
								<th>Package</th>
								<th>Price</th>
								<th>From Date</th>
								<th>Upto Date</th>
								<th>Comments</th>

							</tr>
					@foreach($userpackages as $userpackage)
						<tr>
							<td>{{ $userpackage->package->package or 'NA' }}</td>
							<td>{{ $userpackage->price }} </td>
							<td>{{ $userpackage->fromdate }}</td>
							<td>{{ $userpackage->uptodate }}</td>
							<td>{{ $userpackage->comments }}</td>

						</tr>
					@endforeach
						</table>
						<h2><i class="fa fa-gift"></i> Add New Package for User </h2>

					<form method="post" action="{{ route('admin.update-user') }}" enctype="multipart/form-data">

						<div class="form-group {{ $errors->has('user') ? ' has-error' : '' }}">
							<div class="">
								<label>Package <span class="required">*</span></label>
								{{ Form::select('package_id', $packages, null, ['class' => 'form-control' ]) }}
								
								@if ($errors->has('user'))
									<span class="help-block">
                            			<strong>{{ $errors->first('user') }}</strong>
                          			</span>
								@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
							<div class="">
								<label>Price (Price we are selling) <span class="required">*</span></label> <input name="price" class="form-control" type="text" placeholder="in USD" value="{{ old('price') }}"/>
								@if ($errors->has('price'))
									<span class="help-block">
                            			<strong>{{ $errors->first('price') }}</strong>
                          			</span>							
                          		@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('fromdate') ? ' has-error' : '' }}">
							<div class="">
								<label>From Date (YYYY-MM-DD) <span class="required">*</span></label>
								<input name="fromdate" class="form-control" type="text" placeholder="Enter proper format" value="{{ old('fromdate') }}"/>
								@if ($errors->has('fromdate'))
									<span class="help-block">
                            			<strong>{{ $errors->first('fromdate') }}</strong>
										</span>
								@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('uptodate') ? ' has-error' : '' }}">
							<div class="">
								<label>Upto Date (YYYY-MM-DD) <span class="required">*</span></label>
								<input name="uptodate" class="form-control" type="text" placeholder="Enter proper format" value="{{ old('uptodate') }}"/>
								@if ($errors->has('uptodate'))
									<span class="help-block">
                            			<strong>{{ $errors->first('uptodate') }}</strong>
										</span>
								@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('comments') ? ' has-error' : '' }}">
							<div class="">
								<label>Comments <span class="required">*</span></label>
								<input name="comments" class="form-control" type="text" placeholder="Transaction or Reference #" value="{{ old('comments') }}"/>
								@if ($errors->has('comments'))
									<span class="help-block">
                            			<strong>{{ $errors->first('comments') }}</strong>
										</span>
								@endif
							</div>
						</div>


						<div class="form-group">
							<div class="">
								<input type="hidden" name="id" value="0"/>
								<input type="hidden" name="user_id" value="{{ $user->id }}"/>
								<input class="btn btn-primary" type="submit" value="Submit"/>
								{{ csrf_field() }}
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</section>

@endsection