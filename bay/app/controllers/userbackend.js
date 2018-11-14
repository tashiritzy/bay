var app = angular.module('App', [], ['$httpProvider', function ($httpProvider) {
    $httpProvider.defaults.headers.post['X-CSRF-TOKEN'] = $('meta[name=csrf-token]').attr('content');
}]);

app.directive('ngFiles', ['$parse', function ($parse) {
 
    function file_links(scope, element, attrs) {
        var onChange = $parse(attrs.ngFiles);
        element.on('change', function (event) {
            onChange(scope, {$files: event.target.files});
        });
    }
 
    return {
        link: file_links
    }
}]);

app.controller('FileUploadController', ['$scope', '$http', '$window', function ($scope, $http) {

	var API_URL = "http://localhost/bay/bay/bay/api/v1/";
	
    $scope.errors = [];

    $scope.files = [];
    $scope.listFiles = function () {
        var request = {
            method: 'GET',
            url: 'images/' + url(5),
            headers: {
                    'Content-Type': undefined
                }
            };
            $http(request)
                .then(function success(e) {
                    $scope.files = e.data.files;
                }, function error(e) {

        });
    };

    $scope.listFiles();

    var formData = new FormData();

    $scope.uploadFile = function () {

        var request = {
            method: 'POST',
            url: API_URL + 'imageupload',
            data: formData,
            headers: {
                'Content-Type': undefined
            }
        };

        $http(request)
            .then(function success(e) {
                $scope.files = e.data.files;
                $scope.errors = [];
                // clear uploaded file
                var fileElement = $("#image_file");
                fileElement.value = '';
                alert("Image has been uploaded successfully!");
            }, function error(e) {
                $scope.errors = e.data.errors;
            });
    };

    $scope.setTheFiles = function ($files, $advID) {
        angular.forEach($files, function (value, key) {
            
            formData.append('image_file', value);
            formData.append('advID', $advID);
        });
    };

    $scope.deleteFile = function (index) {
        var conf = confirm("Do you really want to delete this file?");

        if (conf == true) {
            var request = {
                method: 'POST',
                url: '/delete/file',
                data: $scope.files[index]
            };

            $http(request)
                .then(function success(e) {
                    $scope.errors = [];

                    $scope.files.splice(index, 1);

                }, function error(e) {
                    $scope.errors = e.data.errors;
                });
        }
    };

}]);
