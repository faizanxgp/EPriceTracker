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
			<p class="text-center pv">SIGN IN TO CONTINUE.</p>
			@if($errors->has('email'))
				<div class="alert alert-danger">
					{{ $errors->first('email') }}
				</div>
			@endif
			<form role="form" data-parsley-validate="" class="mb-lg" method="post" action="{{ route('login') }}">
				<div class="form-group has-feedback">
					<input id="exampleInputEmail1" name="email" type="email" placeholder="Enter email" autocomplete="off" required class="form-control" value="{{ old('email') }}">
					<span class="fa fa-envelope form-control-feedback text-muted"></span>
					@if ($errors->has('email'))
						<span class="help-block">
							<strong>{{ $errors->first('email') }}</strong>
						</span>
					@endif
				</div>
				<div class="form-group has-feedback">
					<input id="exampleInputPassword1" name="password" type="password" placeholder="Password" required class="form-control">
					<span class="fa fa-lock form-control-feedback text-muted"></span>
				</div>
				<div class="clearfix">
					<div class="checkbox c-checkbox pull-left mt0">
						<label>
							<input type="checkbox" value="" name="remember">
							<span class="fa fa-check"></span>Remember Me</label>
					</div>
					<div class="pull-right"><a href="{{ route('password.request') }}" class="text-muted">Forgot your password?</a>
					</div>
				</div>
				<button type="submit" class="btn btn-block btn-primary mt-lg">Login</button>
				{{ csrf_field() }}
			</form>
			<p class="pt-lg text-center">Need to Signup?</p>
			<p><a href="{{ route('register') }}" class="btn btn-block btn-default">Register Now</a></p>

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
                {{--<div class="panel-heading">Login</div>--}}
                {{--<div class="panel-body">--}}
                    {{--<form class="form-horizontal" method="POST" action="{{ route('login') }}">--}}
                        {{--{{ csrf_field() }}--}}

                        {{--<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">--}}
                            {{--<label for="email" class="col-md-4 control-label">E-Mail Address</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>--}}

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
                            {{--<div class="col-md-6 col-md-offset-4">--}}
                                {{--<div class="checkbox">--}}
                                    {{--<label>--}}
                                        {{--<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me--}}
                                    {{--</label>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        {{--<div class="form-group">--}}
                            {{--<div class="col-md-8 col-md-offset-4">--}}
                                {{--<button type="submit" class="btn btn-primary">--}}
                                    {{--Login--}}
                                {{--</button>--}}

                                {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
                                    {{--Forgot Your Password?--}}
                                {{--</a>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</form>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}
@endsection
