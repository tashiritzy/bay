<style type="text/css">
	body,html{ height:100%}
	
	body { 
		margin:auto;
		justify-content: center;
		align-items:center;
	}
	#container {
		margin:auto;
		width:800px;
	 }
</style>
<link href="{{ captcha_layout_stylesheet_url() }}" type="text/css" rel="stylesheet">
@extends('layouts.app')

@section('content')
<div id="container">
<?php
//include "navigation.php";
?>

<form class="" action="{{ url('/breg') }}" method="post" enctype="multipart/form-data">
	<h1>Business Registration</h1><br/>
	<select name="businesstype">
		<option>Select</option>
		<option value="1">Retail</option>
		<option value="2">Hotel</option>
		<option value="3">Tourism</option>
		<option value="4">Information Technology</option>
	</select><br>
	<input type="text" name="businessname" value="" placeholder="Business Title"><br>
	
	{{ ($errors->has('title')) ? $errors->first('title') : '' }}<br>
	<textarea name="description" rows="5" cols="40" placeholder="Descriptions"></textarea>
		{{ ($errors->has('post')) ? $errors->first('post') : '' }}<br>
		
	<input type="text" name="email" value="" placeholder="Email"><br>
	
	<input type="text" name="phone" value="" placeholder="Phone Number"><br>
	
	<select name="location">
		<option>Select</option>
		<option value="1">Thimphu</option>
		<option value="2">Punakha</option>
		<option value="3">Paro</option>
		<option value="4">Wangdue</option>
	</select><br>
	
	<textarea name="address" rows="3" cols="40" placeholder="Address"></textarea>
	<br> Select Your Image
	{{ csrf_field() }}
	  
	 <input type="file" name="avatar"></input>
	<br>

	<div class="form-group{{ $errors->has('CaptchaCode') ? ' has-error' : '' }}">

        <label class="col-md-4 control-label">Captcha</label>
		<div class="col-md-6">

             {!! captcha_image_html('ContactCaptcha') !!}

             <input class="form-control" type="text" id="CaptchaCode" name="CaptchaCode" style="margin-top:5px;">
                @if ($errors->has('CaptchaCode'))
					<span class="help-block">
					<strong>{{ $errors->first('CaptchaCode') }}</strong>
					</span>
				@endif
		</div>
    </div>
	<br><br><br><br>
	
	<input type="hidden" name="_token" value="{{ csrf_token() }}"><br>
	<input type="submit" name="name" value="Register">
	
</form>
<div>
@endsection
