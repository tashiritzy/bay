<h3>My Advertisements</h3>

@if($bssr->count())

@foreach($bssr as $data )

    <div class="row">
		<div class="col-md-4 view overlay justify-content-center align-self-center" style="height:200px">
    		<img src="avatar/{{ $data->path }}" class="advimage"> &nbsp; &nbsp;&nbsp;    		
    	</div>
		<div class="col-md-8">
			<font size="5"> <a href="{{ url('details/'.$data->id) }}">{{ $data->advtopic }}</a></font> 
			<br/>
			<font color="#2ecc71 " size="4"> Nu. {{ $data->price }}</font> 
			<br>
			@if ($data->email)
			<img src="images/email.jpg" height="30px" width="28px" title="Email">{{ $data->email }}
			&nbsp;&nbsp;
			@endif
			
			@if ($data->phone)
			<img src="images/phone.jpg" height="30px" width="28px" title="Phone">{{ $data->phone }}
			@endif
			 <br/>
			
			<font color="#1ccfef" size="2">Posted on {{ date('d F, Y', strtotime($data->created_at)) }} </font>
			<br/>
			<img src="images/location.jpg" height="25px" width="22px"> {{ $data->placename }}
			
			<form name="cmmt" action="{{ url('deleteadv/') }}" method="get">
				{{ csrf_field() }}							
				<button type="submit" class="close" onclick="return confirm('Are you sure you want to delete your ad? You cannot undo this action.');" title="Delete Ad"><font color="red">×</font></button>				
				<input type="hidden" name="advid" value="{{ $data->id }}"/>			
			</form>
		</div>
    </div>
	<hr>

@endforeach
{{ $bssr->links('vendor.pagination.custom') }}
</div>
@else
	<center>Oops! There is nothing to display. Please participate to get more.</center>
@endif
