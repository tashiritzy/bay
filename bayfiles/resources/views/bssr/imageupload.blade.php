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

    	<div class="row">
      	    
           <div class="col-md-8">
            <h3>
	    {{ $images->first()->advtopic }}
	    </h3>
	    </div>
	    
        </div>
        
        
    <form action="{{ url('imageupload') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
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
                <input type="file" name="image" onchange="javascript:this.form.submit();">
                <input type="hidden" name="advid" value="{{ $images->first()->id }}">
                <input type="hidden" name="adtitle" value="{{ $images->first()->advtopic }}">
           </div>
            <div class="col-md-2">
                
                <!--button type="submit" class="btn btn-success">Upload</button-->
                
                
            </div>
        </div>
    </form> 
    
    <div class="row">
    <div class='list-group gallery'>
  	
            @if($images->count())
                @foreach($images as $image)
                <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                    <a class="thumbnail fancybox" rel="ligthbox" href="{{ url('/avatar/'.$image->path) }}">
                        <img class="img-responsive" alt="" src="{{ url('/avatar/'.$image->path) }}" />
                        <div class='text-center'>
                            
                        </div> <!-- text-center / end -->
                    </a>
                    <form action="{{ url('imageupload',$image->picid) }}" method="POST">
                    <input type="hidden" name="_method" value="delete">
                    <input type="hidden" name="advid" value="{{ $image->id }}">

                    {!! csrf_field() !!}

                    <button type="submit" class="close-icon btn btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
                    </form>
                </div> <!-- col-6 / end -->

                @endforeach
                @else
                	Please upload images for better promotion of your ad.
            @endif
        </div> <!-- list-group / end -->
    </div> <!-- row / end -->

    <div class="row">
      	    
           <form action="{{url('postadv')}}" method="post">
           {!! csrf_field() !!}
            <div class="col-md-6">
            	<input type="hidden" name="advid" value="{{ $images->first()->id }}">
                <input type="hidden" name="adtitle" value="{{ $images->first()->advtopic }}">
                
                <button type="submit" class="btn btn-success">Post you Advert</button>
            </div>
            </form>
        </div>


<script type="text/javascript">
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });
    });
</script>

@endsection
