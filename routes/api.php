<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\LoginController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();

});

Route::get('/users', [UserController::class, 'index']);

Route::post('/login/users', [LoginController::class, 'authenticate']);


// Route::prefix('/user')->group( function() {
    
// });
Route::post('/user/logout', [LoginController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'user', 'middleware' => ['auth:sanctum', 'role:admin']], function(){

    Route::post('/store', [UserController::class, 'store']);
    Route::post('/update/{id}', [UserController::class, 'update']);
    Route::get('/edit/{id}', [UserController::class, 'edit']);
    Route::get('/delete/{id}', [UserController::class, 'destroy']);
    
});

Route::post('/expense/save-category', [ExpensesController::class, 'saveCategory'])->middleware('role:admin');
Route::get('/expense/categories', [ExpensesController::class, 'getCategories'])->middleware('role:admin');
Route::get('/expense/data', [ExpensesController::class, 'getData'])->middleware('role:admin');

Route::post('/user/changepassword', [UserController::class, 'changePassword'])->middleware('auth:sanctum');

Route::group(['prefix' => 'expense', 'middleware' => 'auth:sanctum'], function(){

    Route::post('/store/{id}', [ExpensesController::class, 'store']);
    Route::get('/user/{id}', [ExpensesController::class, 'show']);
    Route::get('/categories', [ExpensesController::class, 'getExpenseCategory']);
    Route::get('/edit/{id}', [ExpensesController::class, 'edit']);
    Route::post('/update/{id}', [ExpensesController::class, 'update']);
    Route::get('/delete/{id}', [ExpensesController::class, 'destroy']);

});
