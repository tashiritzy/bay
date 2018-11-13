@extends('layouts.app')

@section('content')

<?php
                        
  Session::set('backUrl', URL::previous());
?>

    <div class="card">
		<h3 class="text-center p-3">Login</h3>
		<hr>
		<div class="card-body center-block">
			<form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
				{{ csrf_field() }}

				<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
					<label for="email" class="col-md-10 control-label">E-Mail Address</label>

					<div class="col-md-10">
						<input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
					<label for="password" class="col-md-4 control-label">Password</label>

					<div class="col-md-10">
						<input id="password" type="password" class="form-control" name="password" required>

						@if ($errors->has('password'))
							<span class="help-block">
								<strong>{{ $errors->first('password') }}</strong>
							</span>
						@endif
					</div>
				</div>

				<div class="form-group">
					<div class="col-md-10 col-md-offset-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="remember"> Remember Me
							</label>
						</div>
					</div>
				</div>

				<div class="form-group row m-3">
					<div class="mx-auto">
						<button type="submit" class="btn btn-primary">
							Login
						</button>

						<a class="btn btn-link" href="{{ url('/password/reset') }}">
							Forgot Your Password?
						</a>
					</div>
				</div>
			</form>
			
			<center>or
				<div class="form-group">
					<div class="col-md-12 col-md-offset-4">
						<a class="btn btn-link" href="{{ url('/auth/facebook') }}">
						<button type="button" class="btn btn-primary">
							 
							&nbsp;&nbsp; Login with Facebook &nbsp;&nbsp;
							
						</button>
						</a>
					   
					</div>
				</div>
			</center>
		</div>            
    </div>
@endsection
