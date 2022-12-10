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

//API route for register new user
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
//API route for login user
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

//Protecting Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // API route for logout user
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);

    Route::get('/checklist', [\App\Http\Controllers\ChecklistController::class, 'getChecklists']);
    Route::post('/checklist', [\App\Http\Controllers\ChecklistController::class, 'store']);
    Route::delete('/checklist/{checklist}', [\App\Http\Controllers\ChecklistController::class, 'destroy']);

    Route::get('/checklist/{checklist}/item', [\App\Http\Controllers\ChecklistItemController::class, 'getItemsChecklist']);
    Route::post('/checklist/{checklist}/item', [\App\Http\Controllers\ChecklistItemController::class, 'store']);
    Route::get('/checklist/{checklist}/item/{checklist_item}', [\App\Http\Controllers\ChecklistItemController::class, 'show']);
    Route::put('/checklist/{checklist}/item/{checklist_item}', [\App\Http\Controllers\ChecklistItemController::class, 'update']);
    Route::delete('/checklist/{checklist}/item/{checklist_item}', [\App\Http\Controllers\ChecklistItemController::class, 'destroy']);
    Route::put('/checklist/{checklist}/item/rename/{checklist_item}', [\App\Http\Controllers\ChecklistItemController::class, 'rename']);
});
