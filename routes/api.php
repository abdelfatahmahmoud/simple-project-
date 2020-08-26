<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware'=> ['api','checkPassword','changeLanguage'], 'namespace'=>'Api'],function(){

   route::post('get-categories','CatController@index');
    route::post('get-categories-active','CatController@activeToUpdate');

    Route::group(['prefix'=>'admin','namespace'=>'Admin'],function(){
    route::get('login','AuthAdminController@checklogin');
});
});


route::group(['middleware'=> ['api','checkPassword','changeLanguage','CheckAdminToken:admin-api'], 'namespace'=>'Api'],function(){

    route::get('offers','CatController@getoofers');

});
