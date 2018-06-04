@extends('layouts.app')

@section('content')

@if (Auth::guest())
	
<center>
	You need to login to Post an Advertisement.
	<br/>
	Click here to <a href="../login"> login</a> or <a href="../register"> register</a>
</center>
@else

<!-- Card -->
<div class="card">

    <!-- Card body -->
    <div class="card-body">

		<form action="{{ url('/create') }}" method="post" enctype="multipart/form-data">
			<h1 class="text-center py-4">Post Your Advert</h1><br/>

			<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
				<label for="name" class="col-md-4 col-xs-12 control-label">Category</label>
				<div class="col-10">
					<select name="category" class="form-control" value="{{ old('category') }}" required autofocus>
						<option value="" selected disabled>Select Category</option>
						@foreach($cat as $cat)
							<option data-content="<span class='label label-success'>Relish</span>" value="{{ $cat->id }}">{{ $cat->categoryname }}</option>
						@endforeach
					</select> 
					@if ($errors->has('category'))
						<span class="help-block">
						<strong>{{ $errors->first('category') }}</strong>
						</span>
					@endif
				</div>				
			</div>
			
			<div class="form-group">
				<label for="Cat" class="col-md-4 col-xs-12 control-label">Title</label>
				<div class="col-10">	
					<input type="text" class="form-control" name="advtopic" value="{{ old('advtopic') }}" placeholder="Title" required autofocus>				
				</div>
			</div>
				
			<div class="form-group">
				<label for="Cat" class="col-md-4 control-label">Description</label>
				<div class="col-10">
					<textarea name="description" class="form-control" rows="5" cols="40" placeholder="Descriptions" required autofocus></textarea>
				</div>
			</div>
			
			<div class="form-group">
				<label for="Cat" class="col-md-4 control-label">Email ID</label>
				<div class="col-10">
					<input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}" placeholder="Email ID" required autofocus>   
				</div>
			</div>
			
			<div class="form-group">
				<label for="Cat" class="col-md-4 col-xs-12 control-label">Phone Number</label>
				<div class="col-10">
					<input type="text" class="form-control" name="phone" value="{{ Auth::user()->phone }}" placeholder="Phone Number" required autofocus>
				</div>
			</div>
			
			<div class="form-group">
				<label for="Cat" class="col-md-4 control-label">Price/Rent/Salary:</label>
				<div class="col-10">
				<input type="text" class="form-control" name="price" value="" placeholder="Price">
				</div>
			</div>
			
			<div class="form-group">
				<label for="Cat" class="col-md-4 control-label">Location</label>
				<div class="col-md-10">
				<select name="location" class="form-control">
					<option value="">Select Location</option>
					@foreach($place as $plce)
						<option value="{{ $plce->id }}"> {{ $plce->placename }}</option>
					@endforeach	
				</select>
				</div>
			</div>
			
			{{ csrf_field() }}
			
			<div class="form-group">
				<label for="Cat" class="col-md-4 control-label"></label>
				<div class="col-10">
					<input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
					<button class="btn btn-outline-default waves-effect" type="submit">
						Post<i class="fa fa-paper-plane-o ml-2"></i>
					</button>
				</div>
			</div>
		</form>

	</div>
</div>
@endif

<!-- AngularJS Application Scripts -->
<script src="<?= asset('app/controllers/userbackend.js') ?>"></script>

@endsection
