@extends('./layouts.app')

@section('content')

    <style type="text/css">

    .gallery
    {
        display: inline-block;
        margin-top: 20px;
    }
    .close-icon{
    	border-radius: 50%;
        position: absolute;
        right: 5px;
        top: -10px;
        padding: 5px 8px;
    }
    .form-image-upload{
        background: #e8e8e8 none repeat scroll 0 0;
        padding: 5px 5px 5px 5px;
    }
    </style>

<div ng-app="App" ng-controller="FileUploadController">  
  	<div class="row">
      	    
           <div class="col-md-8">
                <h3>
                {{ $adv->advtopic }}
                </h3>
            </div>
	    
        </div>

    <!--form action="{{ url('imageupload') }}" class="form-image-upload" method="POST" enctype="multipart/form-data"-->
        {!! csrf_field() !!}
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif
       
       <div class="row">
      	    
           <div class="col-md-6">
                
		        <div class="form-group">
                    <label for="files">Select Image File</label>
                    <label class="btn btn-default">
                    <input type="file" ng-model="image_file" onchange="angular.element(this).scope().uploadFile()" ng-files="setTheFiles($files, {{ $adv->id }})" id="image_file" class="form-control">
                    </label>
                </div>
                <ul class="alert alert-danger" ng-if="errors.length > 0">
                    <li ng-repeat="error in errors">
                        @{{ error }}
                    </li>
                </ul>
  		
           </div>
            
        </div>
    <!--/form--> 
    
    <div id="imageGal" ng-if="files.length > 0" class="row">  	
        <div ng-repeat="file in files" class='col-sm-4 col-xs-6 col-md-3 col-lg-3 mb-2'>
            
            <a data-fancybox="gallery" href="{{ url('/avatar/') }}/@{{ file.path  }}">
                <img height="100px" src="{{ url('/avatar/') }}/@{{ file.path  }}">
            </a>

            <form action="{{ url('imagedelete') }}" method="POST">
            <input type="hidden" name="_method" value="delete">
            <input type="hidden" name="advid" value="{{ $adv->id  }}">
            <input type="hidden" name="pic_id" value="@{{ file.picid  }}">

            {!! csrf_field() !!}

            <button type="submit" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
            </form>
        </div> <!-- col-6 / end -->

    </div> <!-- row / end -->

    <div class="row">
      	    
           <form action="{{url('postadv')}}" method="post">
           {!! csrf_field() !!}
            <div class="col-md-6">
            	<input type="hidden" name="advid" value="{{ $adv->id }}">
                <input type="hidden" name="adtitle" value="{{ $adv->advtopic }}">
                
                <button type="submit" class="btn btn-success">Post you Advert</button>
            </div>
            </form>
        </div>


</div>

<!-- AngularJS Application Scripts -->
<script src="<?= asset('app/controllers/userbackend.js') ?>"></script>

@endsection
