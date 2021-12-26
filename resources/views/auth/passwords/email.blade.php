@extends('layouts.login')

@section('content')
	<div class="panel panel-dark panel-flat">
		<div class="panel-heading text-center">
			<a href="#"> <img src="{{ URL::to('img/e-icon-64.png') }}" alt="Image" class="block-center img-rounded"> </a>
		</div>
		<div class="panel-body">
			<p class="text-center pv">RESET PASSWORD</p>
			<form role="form" data-parsley-validate="" class="mb-lg" method="post" action="{{ route('password.email') }}">
				<div class="form-group has-feedback">
					<input id="exampleInputEmail1" name="email" type="email" placeholder="Enter email" autocomplete="off" required class="form-control">
					<span class="fa fa-envelope form-control-feedback text-muted"></span>
				</div>


				<button type="submit" class="btn btn-block btn-primary mt-lg">Login</button>
				{{ csrf_field() }}
			</form>
			<p class="pt-lg text-center">Need to Signup?</p><a href="{{ route('register') }}" class="btn btn-block btn-default">Register Now</a>




			{{--<form class="form-horizontal" method="POST" action="{{ route('password.email') }}">--}}
				{{--{{ csrf_field() }}--}}

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

				{{--<div class="form-group">--}}
					{{--<div class="col-md-6 col-md-offset-4">--}}
						{{--<button type="submit" class="btn btn-primary">--}}
							{{--Send Password Reset Link--}}
						{{--</button>--}}
					{{--</div>--}}
				{{--</div>--}}
			{{--</form>--}}
		</div>
	</div>

@endsection
