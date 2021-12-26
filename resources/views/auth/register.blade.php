@extends('layouts.login')


@section('content')
	<!-- START panel-->
	<div class="panel panel-dark panel-flat">
		<div class="panel-heading text-center">
			<a href="#">
				<img src="{{ URL::to('img/e-icon-64.png') }}" alt="Image" class="block-center img-rounded">
			</a>
		</div>
		<div class="panel-body">
			<p class="text-center pv">SIGNUP TO GET INSTANT ACCESS.</p>
			@if(Session::has('flash_message'))
				<div class="alert alert-success">
					{{ Session::get('flash_message') }}
				</div>
			@endif
			<form role="form" data-parsley-validate="" class="mb-lg" method="post" action="{{ route('register') }}">
				<div class="form-group has-feedback {{ $errors->has('first_name') ? ' has-error' : '' }}">
					<label for="inputFirstName" class="text-muted">First Name <span class="required">*</span> </label>
					<input id="inputFirstName" type="text" name="first_name" placeholder="Enter first name" autocomplete="off" required class="form-control" value="{{ old('first_name') }}">
					<span class="fa fa-user form-control-feedback text-muted"></span>
					@if ($errors->has('first_name'))
						<p class="help-block">
							<strong>{{ $errors->first('first_name') }}</strong>
						</p>
					@endif
				</div>
				<div class="form-group has-feedback {{ $errors->has('last_name') ? ' has-error' : '' }}">
					<label for="inputLastName" class="text-muted">Last Name <span class="required">*</span></label>
					<input id="inputLastName" type="text" name="last_name" placeholder="Enter last name" autocomplete="off" required class="form-control" value="{{ old('last_name') }}">
					<span class="fa fa-user form-control-feedback text-muted"></span>
					@if ($errors->has('last_name'))
						<p class="help-block">
							<strong>{{ $errors->first('last_name') }}</strong>
						</p>
					@endif
				</div>
				<div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="signupInputEmail" class="text-muted">Email address <span class="required">*</span></label>
					<input id="signupInputEmail" type="email" name="email" placeholder="Enter email" autocomplete="off" required class="form-control" value="{{ old('email') }}">
					<span class="fa fa-envelope form-control-feedback text-muted"></span>
					@if ($errors->has('email'))
						<p class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</p>
					@endif
				</div>
				<div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="signupInputPassword1" class="text-muted">Password <span class="required">*</span></label>
					<input id="signupInputPassword1" type="password" name="password" placeholder="Password" autocomplete="off" required class="form-control">
					<span class="fa fa-lock form-control-feedback text-muted"></span>
					@if ($errors->has('password'))
						<p class="help-block">
							<strong>{{ $errors->first('password') }}</strong>
						</p>
					@endif
				</div>
				<div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
					<label for="signupInputRePassword2" class="text-muted">Retype Password <span class="required">*</span></label>
					<input id="signupInputRePassword2" type="password" name="password_confirmation" placeholder="Retype Password" autocomplete="off" required data-parsley-equalto="#signupInputPassword1" class="form-control">
					<span class="fa fa-lock form-control-feedback text-muted"></span>
					@if ($errors->has('password_confirmation'))
						<p class="help-block">
							<strong>{{ $errors->first('password_confirmation') }}</strong>
						</p>
					@endif
				</div>

				<div class="form-group has-feedback {{ $errors->has('phone') ? ' has-error' : '' }}">
					<label for="signupInputPhone" class="text-muted">Phone</label>
					<input id="signupInputPhone" type="text" name="phone" placeholder="Enter phone number" autocomplete="off" class="form-control" value="{{ old('phone') }}">
					<span class="fa fa-phone form-control-feedback text-muted"></span>
					@if ($errors->has('phone'))
						<p class="help-block">
							<strong>{{ $errors->first('phone') }}</strong>
						</p>
					@endif
				</div>

				<div class="form-group has-feedback {{ $errors->has('website') ? ' has-error' : '' }}">
					<label for="signupInputUrl" class="text-muted">Website URL <span class="required">*</span> </label>
					<input id="signupInputUrl" type="text" name="website" placeholder="Enter website" autocomplete="off" class="form-control" value="{{ old('website') }}">
					<span class="fa fa-globe form-control-feedback text-muted"></span>
					@if ($errors->has('website'))
						<p class="help-block">
							<strong>{{ $errors->first('website') }}</strong>
						</p>
					@endif
				</div>
				<div class="clearfix">
					<div class="checkbox c-checkbox pull-left mt0">
						<label>
							<input type="checkbox" value="" required name="agreed">
							<span class="fa fa-check"></span>I agree with the <a href="{{ route('faq') }}">Term and Conditions</a>
						</label>
					</div>
				</div>
				<button type="submit" class="btn btn-block btn-primary mt-lg">Create account</button>

				{{ csrf_field() }}
			</form>
			<p class="pt-lg text-center">Have an account?</p><p><a href="{{ route('login') }}" class="btn btn-block btn-default">Signin</a></p>

			{{--<p class="text-center"><a class="loginBtn loginBtn--facebook" href="{{ url('/auth/facebook') }}">--}}
					{{--Login with Facebook--}}
				{{--</a></p>--}}

			{{--<p class="text-center"><a class="loginBtn loginBtn--google" href="{{ url('/auth/google') }}">--}}
					{{--Login with Google--}}
				{{--</a></p>--}}
		</div>
	</div>
	<!-- END panel-->




{{--<div class="container">--}}
    {{--<div class="row">--}}
        {{--<div class="col-md-8 col-md-offset-2">--}}
            {{--<div class="panel panel-default">--}}
                {{--<div class="panel-heading">Register</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" method="POST" action="{{ route('register') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">--}}
                            {{--<label for="name" class="col-md-4 control-label">First Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="firstname" type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required autofocus>--}}

                                {{--@if ($errors->has('first_name'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('first_name') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

						{{--<div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">--}}
							{{--<label for="name" class="col-md-4 control-label">Last Name</label>--}}

							{{--<div class="col-md-6">--}}
								{{--<input id="lastname" type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required autofocus>--}}

								{{--@if ($errors->has('last_name'))--}}
									{{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('last_name') }}</strong>--}}
                                    {{--</span>--}}
								{{--@endif--}}
							{{--</div>--}}
						{{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>--}}

                                {{--@if ($errors->has('email'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('email') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">--}}
                            {{--<label for="password" class="col-md-4 control-label">Password</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="password" type="password" class="form-control" name="password" required>--}}

                                {{--@if ($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('password') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}

						{{--<div class="form-group">--}}
							{{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>--}}

							{{--<div class="col-md-6">--}}
								{{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>--}}
							{{--</div>--}}
						{{--</div>--}}

						{{--<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">--}}
							{{--<label for="name" class="col-md-4 control-label">Phone</label>--}}

							{{--<div class="col-md-6">--}}
								{{--<input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>--}}

								{{--@if ($errors->has('phone'))--}}
									{{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('phone') }}</strong>--}}
                                    {{--</span>--}}
								{{--@endif--}}
							{{--</div>--}}
						{{--</div>--}}

						{{--<div class="form-group{{ $errors->has('website') ? ' has-error' : '' }}">--}}
							{{--<label for="name" class="col-md-4 control-label">Website</label>--}}

							{{--<div class="col-md-6">--}}
								{{--<input id="website" type="text" class="form-control" name="website" value="{{ old('website') }}" required autofocus>--}}

								{{--@if ($errors->has('website'))--}}
									{{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('website') }}</strong>--}}
                                    {{--</span>--}}
								{{--@endif--}}
							{{--</div>--}}
						{{--</div>--}}



                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Register--}}
                                {{--</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
