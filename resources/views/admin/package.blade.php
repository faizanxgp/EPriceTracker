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
					<h2><i class="fa fa-gift"></i> Update Package </h2>
					<form method="post" action="{{ route('admin.update-package') }}" enctype="multipart/form-data">

						<div class="form-group {{ $errors->has('package') ? ' has-error' : '' }}">
							<div class="">
								<label>Package Name <span class="required">*</span></label> <input name="package" class="form-control" type="text" placeholder="Enter package name in full" value="{{ $package->package or old('package') }}"/>
								@if ($errors->has('package'))
									<span class="help-block">
                            			<strong>{{ $errors->first('package') }}</strong>
                          			</span>
								@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
							<div class="">
								<label>Sell Price (Price we are selling) <span class="required">*</span></label> <input name="price" class="form-control" type="text" placeholder="Enter package price" value="{{ $package->price or old('price')
								}}"/>
								@if ($errors->has('price'))
									<span class="help-block">
                            			<strong>{{ $errors->first('price') }}</strong>
                          			</spa>							
                          		@endif
							</div>
						</div>

						<div class="form-group {{ $errors->has('connects') ? ' has-error' : '' }}">
							<div class="">
								<label>Connects <span class="required">*</span></label> <input name="connects" class="form-control" type="text" placeholder="Enter connects allowed" value="{{ $package->connects or old('connects') }}"/>
								@if ($errors->has('connects'))
									<span class="help-block">
                            			<strong>{{ $errors->first('connects') }}</strong>
										</spa>
								@endif
							</div>
						</div>


						<div class="form-group">
							<div class="">
								<input type="hidden" name="id" value="{{ $package->id }}"/>
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