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
Route::get('manage-item-ajax', 'ItemAjaxController@manageItemAjax');

Route::resource('item-ajax', 'BssrController');

Route::put('item-ajax/{id}', 'BregController@update');

////////////////////////////breg/////////////////////////////////

Route::get('breg', 'BregController@index');

Route::get('/breg/create', 'BregController@create');

Route::get('/breg/verify', 'BregController@verify');

Route::get('/breg/{id}', 'BregController@show');

Route::get('/breg/{id}/edit', 'BregController@edit');

Route::post('breg', 'BregController@store');

Route::put('/breg/{id}', 'BregController@update');

Route::delete('/breg/{id}', 'BregController@destroy');

Route::post('/breg/approve/{id}', 'BregController@approve');

///////////////////////////breg end//////////////////////
Auth::routes();

Route::get('/home', 'BssrController@bssr');

///////////////////////////bssr///////////////////////////

//Route::get('/bssr', function () {
//    return view('bssr');
//});

Route::get('/', 'BssrController@bssr');

Route::get('/bssr/create', 'BssrController@create');

Route::post('create', 'BssrController@storeadv');

Route::get('/bssrsearch', 'BssrController@bssrsearch');

Route::get('bssrfilter', 'BssrController@bssrfilter');

Route::get('details/{id}', 'BssrController@details');

Route::post('/bssrcomment', 'BssrController@comment');

Route::get('commentdelete', 'BssrController@commentdelete');

Route::get('imageupload/{advid}', 'BssrController@imageindex');

Route::post('imageupload', 'BssrController@imageupload');

Route::delete('imageupload/{id}', 'BssrController@imagedestroy');

Route::get('categoryview/{catid}', 'BssrController@categoryview');

Route::get('userhome', 'BssrController@userhome');

Route::get('useradvs', 'BssrController@useradvs');

Route::get('usercomment', 'BssrController@commentedadvs');

Route::get('deleteadv', 'BssrController@deleteadv');

Route::post('postadv', 'BssrController@postadv');

Route::get('myaccount', 'BssrController@myaccount');

Route::post('myaccount', 'BssrController@myaccountupdate');

Route::get('auth/facebook', 'Auth\RegisterController@redirectToProvider');
Route::get('auth/facebook/callback', 'Auth\RegisterController@handleProviderCallback');

//////////////////// angular filter //////////////////////////

Route::get('bssrfilter', function () {
    return view('bssr.bssrfilter');
});

Route::get('/api/v1/bssrfilter/{id?}', 'BssrController@index');
Route::post('/api/v1/bssrfilter1', 'BssrController@filter');
Route::post('/api/v1/employees/{id}', 'Employees@update');
Route::delete('/api/v1/employees/{id}', 'Employees@destroy');

