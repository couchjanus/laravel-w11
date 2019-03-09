<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
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


Route::group(
    ['middleware' => 'api'],
    function () {
        Route::get(
            'post/{id}/comments',
            function ($id) {
                return \App\Post::findOrFail($id)->comments;
            }
        );

        Route::post(
            'post/{id}/comment',
            function ($id, Request $request) {
                $user = \App\User::first();
                \App\Post::findOrFail($id)->comment($request->all(), $user);
                return response()->json([$request->all()]);
            }
        );

        Route::patch(
            'post/{id}/comment/{comment_id}',
            function ($id,$comment_id, Request $request) {
                return \App\Post::findOrFail($id)->updateComment($comment_id, $request->except('user_id'));
            }
        );

        Route::delete(
            'post/{id}/comment/{comment_id}',
            function ($id,$comment_id) {
                \App\Post::findOrFail($id)->deleteComment($comment_id);
                return 'deleted';
            }
        );

    }
);
