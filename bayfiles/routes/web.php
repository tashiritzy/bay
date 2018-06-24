<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::get('/logout', function(){
	Auth::logout();
	return redirect('/');
});
Route::auth();

Route::get('/got', [
  'middleware' => ['auth'],
  'uses' => function () {
   echo "You are allowed to view this page!";
}]);

Route::get('/', function () {
    return view('/bssr');
});

//////////////////////////////ajax//////////////////////////////////

Auth::routes();

Route::get('/home', 'BssrController@bssr');

///////////////////////////bssr///////////////////////////

Route::get('/', 'BssrController@bssr');

Route::get('/bssr/create', 'BssrController@create');

Route::post('create', 'BssrController@storeadv');

Route::get('/bssrsearch', 'BssrController@bssrsearch');

//Route::get('bssrfilter', 'BssrController@bssrfilter');

Route::get('details/{id}', 'BssrController@details');

Route::post('/bssrcomment', 'BssrController@comment');

Route::get('commentdelete', 'BssrController@commentdelete');

Route::get('imageupload/{advid}', 'BssrController@imageupload');

Route::post('imageupload', 'BssrController@imageupload');

Route::delete('imagedelete', 'BssrController@imagedestroy');

Route::get('categoryview/{cat}', 'BssrController@categoryview');

Route::get('/api/v1/categoryviewdata/{catid}', 'BssrController@categoryviewData');

Route::get('userhome', 'BssrController@userhome');

Route::get('useradvs', 'BssrController@useradvs');

Route::get('usercomment', 'BssrController@commentedadvs');

Route::get('deleteadv', 'BssrController@deleteadv');

Route::post('postadv', 'BssrController@postadv');

Route::get('myaccount', 'BssrController@myaccount');

Route::post('myaccount', 'BssrController@myaccountupdate');

Route::get('test', function () {
    return view('test');
});

Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

//////////////////// angular filter //////////////////////////

Route::get('/api/v1/bssrfilter/{id?}', 'BssrController@index');
Route::post('/api/v1/bssrfilter1', 'BssrController@filter');


 
Route::get('imageupload/images/{advid}', 'BssrController@getAdvImages');
 
Route::post("/delete/file", "BssrController@filedestroy");
