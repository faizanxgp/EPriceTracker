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
										<h3>Update Account</h3>
										@if(Session::has('flash_message'))
											<div class="alert alert-success">
												{{ Session::get('flash_message') }}
											</div>
										@endif
										<form method="post" action="{{ route('update-user') }}">
											<div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }}">
												<label>First Name <span class="required">*</span> </label> <input class="form-control" type="text" name="first_name" value="{{ $user->first_name }}" required />
												@if ($errors->has('first_name'))
													<p class="help-block">
														<strong>{{ $errors->first('first_name') }}</strong>
													</p>
												@endif

											</div>
											<div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }}">
												<label>Last Name <span class="required">*</span> </label> <input class="form-control" type="text" name="last_name" value="{{ $user->last_name }}" required />
												@if ($errors->has('last_name'))
													<p class="help-block">
														<strong>{{ $errors->first('last_name') }}</strong>
													</p>
												@endif

											</div>
											<div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
												<label>Email <span class="required">*</span> </label> <input class="form-control" type="email" name="email" value="{{ $user->email }}" required />
												@if ($errors->has('email'))
													<p class="help-block">
														<strong>{{ $errors->first('email') }}</strong>
													</p>
												@endif

											</div>

											<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
												<label>Password <span class="required">*</span> </label> <input class="form-control" type="password" name="password" value=""  />
												@if ($errors->has('password'))
													<p class="help-block">
														<strong>{{ $errors->first('password') }}</strong>
													</p>
												@endif
<p class="error">Leave blank to keep exisitng password</p>
											</div>
											<div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
												<label>Password Confirmation <span class="required">*</span> </label> <input class="form-control" type="password" name="password_confirmation" value=""  />
												@if ($errors->has('password_confirmation'))
													<p class="help-block">
														<strong>{{ $errors->first('password_confirmation') }}</strong>
													</p>
												@endif

											</div>
											<div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
												<label>Phone </label> <input class="form-control" type="text" name="phone" value="{{ $user->phone }}" />
												@if ($errors->has('phone'))
													<p class="help-block">
														<strong>{{ $errors->first('phone') }}</strong>
													</p>
												@endif

											</div>
											<div class="form-group {{ $errors->has('website') ? ' has-error' : '' }}">
												<label>Website </label> <input class="form-control" type="text" name="website" value="{{ $user->website }}" />
												@if ($errors->has('website'))
													<p class="help-block">
														<strong>{{ $errors->first('website') }}</strong>
													</p>
												@endif

											</div>


											<div class="form-group">
												<input type="submit" class="btn btn-primary" value="Update" name=""/>
												<input type="hidden" name="id" value="{{ $user->id }}" />
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