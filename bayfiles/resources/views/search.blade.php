     <div class="panel panel-default">
    	<div class="panel-body">
    		<form class="" name="searchform" method="get" action="{{ url('/bssrsearch') }}">

<style>
input#search{
	
  width: 100%;
  height: 50px;
  background: #FAFAFA;
  font-size: 10pt;
  color: #00000;
  border: 1px solid #C6D1AD;
}
input#search:hover, input#search:focus, input#search:active{
    outline:none;
    background: #f4f6f6 ;
  }
</style>    
	
	
	<div class="row">
           <div id="custom-search-input">
                            <div class="input-group col-md-12">
                                <input type="text" id="search" name="searchkey" class="search-query form-control" placeholder="Search..." />
                                <span class="input-group-btn">
                                    <button class="btn btn-danger" type="submit">
                                        <span class=" glyphicon glyphicon-search"></span>
                                       
                                    </button>
                                </span>
                            </div>
             </div>
	</div>
		</form>
<style>
    #custom-search-input {
        margin-left:15px;
        margin-top: 0;
        margin-right: 10px;
    }
 
    #custom-search-input .search-query {
        padding-right: 3px;
        padding-right: 4px \9;
        padding-left: 15px;
        padding-left: 4px \9;
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
 
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
    }
 
    #custom-search-input button {
        border: 0;
        background: #16e1e1;
        height: 50px;
        width: 35px;
        /** belows styles are working good */
        padding: 2px 5px;
        margin-top: 7px;
        position: relative;
        left: 0px;
       
        /* IE7-8 doesn't have border-radius, so don't indent the padding */
        margin-bottom: 0;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        color: #000;
        vertical-align: middle;
    }
 
    .search-query:focus + button {
        z-index: 3;
    }
</style>

  
         </div>
      </div>
