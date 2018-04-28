{{ Session::get('message') }}

<style type="text/css">
	body,html{ height:100%}
	
	body { 
		
		justify-content: center;
		align-items:center;
	}
	#container {
		margin:auto;
		width:800px;
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

<body id="container">
<h1> Business List</h1>
----------------------------- <a href="breg/create"> Register your business</a>

	<form class="" method="GET" action="{{ url('/breg') }}">
      <div class="input-group custom-search-form">
        <input type="text" name="search" class="form-control" placeholder="Search ....">
        <span class="input-group-btn">
          <button type="submit" class="btn btn-default-sm">
            <i class="fa fa-search"></i>
          </button>
        </span>
      </div>
     </form>


<!--table>
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
<img src="avatar/{{ $data-> imagepath }}" height="30">
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
<td>
		<a href="breg/{{ $data->id }}/edit"> Edit Post</a>

</td>
<td>
		<form class="" action="breg/{{ $data->id }}" method="post">
			<input type="hidden" name="_method" value="delete">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<input type="submit" name="name" value="Delete Post">
		</form>
</td>
</tr>
@endforeach
<tr>
<td colspan="6">
{{ $bregs->links('vendor.pagination.custom') }}
{!! $bregs->links() !!}
</td>
</tr>
</table-->

<div class="row">
    <div class="table-responsive">
      <table class="table table-borderless" id="table">
        <tr>
          <th>No.</th>
          <th>Title</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
        {{ csrf_field() }}

        <?php $no=1; ?>
        @foreach($bregs as $breg)
          <tr class="item{{$breg->id}}">
            <td>{{$no++}}</td>
            <td>{{$breg->businessname}}</td>
            <td>{{$breg->description}}</td>
            <td>
            <button class="edit-modal btn btn-primary" data-id="{{$breg->id}}" data-title="{{$breg->businessname}}" data-description="{{$breg->description}}">
              <span class="glyphicon glyphicon-edit"></span> Edit
            </button>
            <button class="delete-modal btn btn-danger" data-id="{{$breg->id}}" data-title="{{$breg->description}}" data-description="{{$breg->description}}">
              <span class="glyphicon glyphicon-trash"></span> Delete
            </button>
          </td>
          </tr>
        @endforeach
      </table>
	  {{ $bregs->links('vendor.pagination.custom') }}
    </div>
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

							<input type="text" name="title" class="form-control" data-error="Please enter title." required />

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
		
	<!-------------------------- Edit End --------------------------------------------->
	
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