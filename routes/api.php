<?php

use App\Http\Controllers\API\BlogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::controller(BlogController::class)->prefix('blog')->group(function () {
        route::get('/list', 'getDataBlog');
        route::get('/{slug}/detail', 'getDataBlogBySlug');
        route::get('/{category_id}/{number}/get', 'getDataSecquence');
        route::get('/category/{category}/detail', 'getDataBlogByCategory');
    });
});
