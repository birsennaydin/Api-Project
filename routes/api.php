<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ApiRegisterController;
use App\Http\Controllers\API\ApiPurchaseController;
use App\Http\Controllers\API\ApiIosController;
use App\Http\Controllers\API\ApiGoogleController;
use App\Http\Controllers\API\ApiSubscriptionController;


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
Route::post('/login', [AuthController::class, 'login']);
//Route::post('/login', 'API\AuthController@login');

Route::post('/register', [ApiRegisterController::class, 'register']);
Route::post('/purchase', [ApiPurchaseController::class, 'purchase']);
Route::post('/ios', [ApiIosController::class, 'store']);
Route::post('/google', [ApiGoogleController::class, 'store']);
Route::post('/subscription', [ApiSubscriptionController::class, 'subscription']);
//Route::post('/', 'ApiIosController@store')->name('posts.store');

//Route::middleware('auth:api')->post('/register', 'API\ApiRegisterController@store');
//Route::middleware('auth:api')->post('/ios', 'API\DeviceController@authentication');
//Route::middleware('auth:api')->post('/google', 'API\DeviceController@authentication');
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});
