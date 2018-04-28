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
	
     /////////////////////////////////////////////////////////
     $scope.loadMore = function() {
        //$scope.loading = true;
        $('.loading').show();
     	var url = API_URL + "bssrfilter";
	$scope.lastpage +=1;
	$http({
	    url: API_URL + "bssrfilter",
	    method: "GET",
	    params: {page:  $scope.lastpage}
	}).success(function (data, status, headers, config) {
	    $scope.bssr = $scope.bssr.concat(data.data);
            
            $('.loading').hide();
	    
	    //console.log(events);
	
	});
	};
     //////////////////////Pagination End ////////////////////
    
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
            console.log(data);
           
            $scope.bssr = data.data;
            
            $scope.currentpage = data.current_page;
            
            $('.loading').hide();
            
            //$scope.bssrfilter = {};
            
        }).error(function(response) {
            console.log(response);
            alert('This is embarassing. An error has occured. Please check the log for details');
        });
    }
    
    //$scope.listSearch();
});