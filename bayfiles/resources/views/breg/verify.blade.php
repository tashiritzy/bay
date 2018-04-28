@extends('layouts.app')
<html>
<style type="text/css">
	body,html{ height:100%}
	
	body { 
		
		justify-content: center;
		align-items:center;
	}
	#container {
		margin:auto;
		width:800px;
		font-family:"Arial";
	 }
</style>

<!----------------------------pagination--------------------------------->
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


	<style type="text/css">

		.my-active span{

			background-color: #5cb85c !important;

			color: white !important;

			border-color: #5cb85c !important;

		}

	</style>
<!-----------------------------pagination end------------------------------>

@section('content')
<body>
<div id="container">

@if(Auth::check())

	<h1> Business List for Approval</h1>
	<center>
	<font color="green">
	{{ Session::get('message') }}
	</font>
	</center>
	<table>
	<tr>
	<th>
	</th>
	<th>
	Title Name
	</th>
	<th>
	Post
	</th>
	<th>
	Edit Action
	</th>
	<th>
	Delete Action
	</th>
	</tr>
	@foreach($bregs as $data )
	<tr>
	<td>
	<img src="../avatar/{{ $data-> imagepath }}" height="30">
	</td>
	<td>
		<a href="breg/{{ $data->id }}">{{ $data-> businessname }}</a>
	</td>
	<td>
			<p>{{ $data -> email }} </p>
	</td>
	<td>
			<p>{{ $data -> description }} </p>
	</td>
	<td data-id="{{ $data -> id }}">
		<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">
			Edit Post
		</button>
	</td>
	<td>
	<br>
			<form class="" action="approve/{{ $data->id }}" method="post">
				<!--input type="hidden" name="_method" value="approve"-->
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<input type="submit" class="btn btn-danger remove-item" name="name" value="Approve Post">
			</form>
	</td>
	</tr>
	<tr>
	<td colspan="6"> <hr> </td>
	</tr>
	@endforeach
	
	<tr>
	<td colspan="6">

	{{ $bregs->links('vendor.pagination.custom') }}
	</td>
	</tr>
	</table>
	
@endif

@if(Auth::guest())
	<a href="/login" class="btn btn-info"> You need to login to see this>></a>
@endif

@endsection
</div>

	<!-- Edit Item Modal -->

		<div class="modal fade" id="edit-item" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">

		  <div class="modal-dialog" role="document">

		    <div class="modal-content">

		      <div class="modal-header">

		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

		        <h4 class="modal-title" id="myModalLabel">Edit Item</h4>

		      </div>

		      <div class="modal-body">


		      		<form data-toggle="validator" action="/item-ajax/14" method="put">

		      			<div class="form-group">

							<label class="control-label" for="title">Title:</label>

							<input type="text" name="businessname" class="form-control" data-error="Please enter title." required />

							<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

							<label class="control-label" for="title">Description:</label>

							<textarea name="description" class="form-control" data-error="Please enter description." required></textarea>

							<div class="help-block with-errors"></div>

						</div>

						<div class="form-group">

							<button type="submit" class="btn btn-success crud-submit-edit">Submit</button>

						</div>

		      		</form>


		      </div>

		    </div>

		  </div>

		</div>


	</div>
	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>

	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>


	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.3.1/jquery.twbsPagination.min.js"></script>


	<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>


	<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">


        <script type="text/javascript">

    	   var url = "<?php echo route('item-ajax.index')?>";

        </script>

        <script src="/js/item-ajax.js"></script> 
</body>
</html>