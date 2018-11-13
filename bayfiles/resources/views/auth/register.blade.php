@extends('layouts.app')

@section('content')

<?php
                        
  Session::set('backUrl', URL::previous());
?>

    <div class="card">        
		<h3 class="text-center p-3">Register</h3>
		<hr>
		<div class="card-body center-block">
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
					<label for="name" class="col-md-10 control-label">Name</label>

					<div class="col-md-10">
						<input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

						@if ($errors->has('name'))
							<span class="help-block">
								<strong>{{ $errors->first('name') }}</strong>
							</span>
						@endif
					</div>
				</div>
				
				<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
					<label for="name" class="col-md-10 control-label">Phone</label>

					<div class="col-md-10">
						<input id="phone" type="text" class="form-control" name="phone" value="{{ old('phone') }}" required autofocus>

						@if ($errors->has('phone'))
							<span class="help-block">
								<strong>{{ $errors->first('phone') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="col-md-10 control-label">E-Mail Address</label>

					<div class="col-md-10">
						<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="col-md-4 control-label">Password</label>

					<div class="col-md-6">
						<input id="password" type="password" class="form-control" name="password" required>

						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

					<div class="col-md-6">
						<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-6 col-md-offset-4">
						<button type="submit" class="btn btn-primary">
							Register
						</button>
					</div>
				</div>
			</form>

			<!--center>or
				<div class="form-group">
					<div class="col-md-8 col-md-offset-4">
						<a class="btn btn-link" href="{{ url('/auth/facebook') }}">
						<button type="button" class="btn btn-primary">
							 
							&nbsp;&nbsp; Login with Facebook &nbsp;&nbsp;
							
						</button>
						</a>
					   
					</div>
				</div>
			</center-->



		</div>            
    </div>

@endsection
