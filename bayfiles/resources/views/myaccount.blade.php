     <div class="panel-heading">My Account Details</div>
	<div class="panel-body">
	    <form class="form-horizontal" role="form" method="POST" action="{{ url('/myaccount') }}">
		{{ csrf_field() }}

		<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
		    <label for="name" class="col-md-4 control-label">Name</label>

		    <div class="col-md-6">
			<input id="name" type="text" name="name" value="{{ Auth::user()->name }}" required>

			@if ($errors->has('name'))
			    <span class="help-block">
				<strong>{{ $errors->first('name') }}</strong>
			    </span>
			@endif
		    </div>
		</div>
		
		<div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
		    <label for="name" class="col-md-4 control-label">Phone</label>

		    <div class="col-md-6">
			<input id="phone" type="text" name="phone" value="{{ Auth::user()->phone }}" required autofocus>

			@if ($errors->has('phone'))
			    <span class="help-block">
				<strong>{{ $errors->first('phone') }}</strong>
			    </span>
			@endif
		    </div>
		</div>

		<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
		    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

		    <div class="col-md-6">
			<input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" required>

			@if ($errors->has('email'))
			    <span class="help-block">
				<strong>{{ $errors->first('email') }}</strong>
			    </span>
			@endif
		    </div>
		</div>
		
		<div class="form-group">
                            <label for="email-confirm" class="col-md-4 control-label">Confirm Email ID</label>

                            <div class="col-md-6">
                                <input id="email-confirm" type="email" 
                                onfocus="validateMail(document.getElementById('email'), this);" 
                                oninput="validateMail(document.getElementById('email'), this);"
                                class="form-control" name="email_confirmation" required>
                            </div>
                </div>

                <script>
		function validateMail(email, p2) {
		if (email.value != p2.value || email.value == '' || p2.value == '') {
		    p2.setCustomValidity('Incorrect Email ID. Please retype!');
		} else {
		    p2.setCustomValidity('');
		}
		}
		</script>
                
		<div class="form-group">
		    <div class="col-md-6 col-md-offset-4">
			<button type="submit" class="btn btn-primary">
			    Save
			</button>
		    </div>
		</div>
	    </form>
	</div>
    </div>
