@extends('layouts.app')

@section('content')

@if (Auth::guest())
	
<center>
	You need to login to Post an Advertisement.
	<br/>
	Click here to <a href="../login"> login</a> or <a href="../register"> register</a>
</center>
@else

<form class="" action="{{ url('/create') }}" method="post" enctype="multipart/form-data">
	<h1>Post Your Advert</h1><br/>

	<div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
	    <label for="name" class="col-md-4 col-xs-12 control-label">Category</label>

	    <div class="col-md-5 col-xs-10">

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
	    <div class="col-md-1 col-xs-2">
	  	<font color="red">  *</font>
	    </div>
	    
	</div>
	
	<div class="form-group">
	    <label for="Cat" class="col-md-4 col-xs-12 control-label">Title</label>

	    <div class="col-md-5 col-xs-10">
		
	   	 
	    <input type="text" name="advtopic" value="{{ old('advtopic') }}" placeholder="Title">
	    <font color="red">{{ ($errors->has('advtopic')) ? $errors->first('advtopic') : '' }}</font>
	    	    
	    </div>
	    <div class="col-md-1 col-xs-2">
	  	<font color="red">  *</font>
	    </div>
	</div>
		
	<div class="form-group">
	    <label for="Cat" class="col-md-4 control-label">Description</label>

	    <div class="col-md-5">
		
	    
	    <textarea name="description" rows="5" cols="40" placeholder="Descriptions"></textarea>
		
	    
	    </div>
	</div>
	
	
	<div class="form-group">
	    <label for="Cat" class="col-md-4 control-label">Email ID</label>

	    <div class="col-md-5">
		<input type="text" name="email" value="{{ Auth::user()->email }}" placeholder="Email ID">   
	    </div>
	</div>
	
	<div class="form-group">
	    <label for="Cat" class="col-md-4 col-xs-12 control-label">Phone Number</label>

	    <div class="col-md-5 col-xs-10">
		<input type="text" name="phone" value="{{ Auth::user()->phone }}" placeholder="Phone Number">
		<font color="red">{{ ($errors->has('phone')) ? $errors->first('phone') : '' }}</font>
	    </div>
	    <div class="col-md-1 col-xs-2">
	  	<font color="red">  *</font>
	    </div>
	</div>
	
	<div class="form-group">
	    <label for="Cat" class="col-md-4 control-label">Price/Rent/Salary:</label>

	    <div class="col-md-5">
		<input type="text" name="price" value="" placeholder="Price">
	    </div>
	</div>
	
	<div class="form-group">
	    <label for="Cat" class="col-md-4 control-label">Location</label>

	    <div class="col-md-5">
		<select name="location">
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

	    <div class="col-md-6">
		<input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
		<input type="submit" name="name" value="Next">
	    </div>
	</div>
	
	
</form>
@endif

@endsection