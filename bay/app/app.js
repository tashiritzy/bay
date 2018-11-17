var app = angular.module('bssrApp', [])
.constant('API_URL', 'http://localhost/bay/bay/bay/api/v1/')
.filter('fromNow', function() {
  return function(date) {
    return moment(date).fromNow();
  }
});
//.constant('API_URL', 'http://bay.druklink.net/api/v1/');