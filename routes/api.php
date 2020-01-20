<?php

use Illuminate\Http\Request;

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

Route::get('/packages/{id}/freebies', function($id){
  $data = array(
    'package'  => App\TopupPackage::find($id),
    'freebies' => App\TopupFreebies::where('package_id', $id)->get()
  );
  return response()->json($data);
});
