<?php

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('posts', function () {

    // Cache::flush();
    // Cache::flush();
    /* $posts = Cache::remember('posts', 120, function () {
        return Post::latest()->get();
    }); */
/* 
    $posts = Post::all();

    $allTitle = '';
    foreach ($posts as $post){
        $allTitle .= $post->title;
    } */

    Cache::put('title', $allTitle);

    //return allTitle();
});