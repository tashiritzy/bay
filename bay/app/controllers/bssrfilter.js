app.controller('bssrfilterController', function($scope, $http, API_URL) {
    //retrieve all data
    //alert('this is me here');
    
    $scope.listSearch = function()
    {
    	    //alert('1');
    	    
    	    $scope.loading = true;
	    	$http.get(API_URL + "bssrfilter")
		    .success(function(data) {
			$scope.bssr = data;
		    });
    };
    
    //////////////////Pagination ///////////////////
	$scope.bssr = [];
	$scope.lastpage=1;
	
	$scope.init = function() {
	var url = API_URL + "bssrfilter";
	$scope.lastpage=1;
	$http({
	    url: url,
	    method: "GET",
	    params: {page:  $scope.lastpage}
	}).success(function(data, status, headers, config) {
	    $scope.bssr = data.data;
	    $scope.currentpage = data.current_page;
	});
	};
	
	$scope.init();
	
	
    //search record
        $scope.search = function() {
        //alert('searchkey');
        //$scope.loading = true;
        $('.loading').show();
        var url = API_URL + "bssrfilter1";
        $scope.lastpage=1;
        
        $http({
            method: 'POST',
            url: url,
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            data: $.param($scope.bssrfilter)
        }).success(function(data) {
            
            $scope.bssr = data.data;
            
            $scope.currentpage = data.current_page;
            
            $('.loading').hide();
            
        }).error(function(response) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }
    
    /////////////////////////////////////////////////////////
	    $scope.loadMore = function() {
		$('.loading').show();
		$scope.lastpage +=1;
		console.log($scope.bssrfilter);
		
		if($scope.bssrfilter !== undefined)
		{
			$http({
			    url: API_URL + "bssrfilter1",
			    method: "POST",
			    headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			    params: {page:  $scope.lastpage},
			    data: $.param($scope.bssrfilter)
			}).success(function (data, status, headers, config) {
			    $scope.bssr = $scope.bssr.concat(data.data);
			    
			    $('.loading').hide();
			
			   });	
			
		}
		else
		{
			
			$('.loading').show();
			var url = API_URL + "bssrfilter";
			
			$http({
			    url: url,
			    method: "GET",
			    params: {page:  $scope.lastpage}
			}).success(function (data, status, headers, config) {
			    $scope.bssr = $scope.bssr.concat(data.data);
			    
			    $('.loading').hide();
			
			});		
		}
		
	};
	
	///////////////////Pagination End ////////////////////
});