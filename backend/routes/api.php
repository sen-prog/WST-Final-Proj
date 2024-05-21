<?php 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserTwoController;
// use App\Http\Controllers\UserController;


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\api\v1', 'middleware' => ['auth:sanctum']], function() {
//     Route::apiResource('users', UserTwoController::class);
// });

// Route::post('/login', [UserController::class, 'login']);
// Route::middleware('auth:sanctum')->post('/logout', [UserController::class, 'logout']);

Route::post('/register', [UserTwoController::class, 'register']);
Route::post('/login', [UserTwoController::class, 'login']);
Route::post('/logout', [UserTwoController::class, 'logout'])->middleware('auth:sanctum');

?>