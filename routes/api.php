<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\API\LessonController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TagController;
use App\Http\Controllers\API\RelationshipController;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
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

//lessons
Route::group(['prefix'=>'/v1' , 'middleware' => 'auth.basic.once' ], function(){

    Route::apiResource('lessons', LessonController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('tags', TagController::class);

Route::any('lesson', function(){
    $message= "please make sure to update your code to use the newer version of our API.
    you shoud use lesson instead of lessons";
    return Response::json([
        'data'=>$message,
        'link'=>url('documentation/api'),

    ]);
});
//Route::redirect('lesson','lessons');


Route::get('users/{id}/lessons', 'App\Http\Controllers\API\RelationshipController@userLessons');
Route::get('lessons/{id}/tags', 'App\Http\Controllers\API\RelationshipController@lessonTags');
Route::get('tags/{id}/lessons', 'App\Http\Controllers\API\RelationshipController@tagLessons');
Route::get('/login', 'App\Http\Controllers\API\LoginController@login');


});
   

