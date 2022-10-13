<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\Admin\ChildrenCategoryController;
use App\Http\Controllers\Admin\GetCommentUserController;
use App\Http\Controllers\Admin\GetPostIsCategoryController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\RegisterUserController;
use App\Http\Controllers\User\LogoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserManagerController;
use App\Http\Controllers\User\ForgetPasswrodController;
use App\Http\Controllers\User\UserDetailController;
use App\Http\Controllers\Admin\AuthAdminController;
use App\Http\Controllers\Admin\AdminManagerController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix'=>'admin','middleware'=>'admin'],function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('posts', PostsController::class);
    Route::resource('children-categories', ChildrenCategoryController::class);
    Route::resource('user-manager', UserManagerController::class);
    Route::get('get-comment-user/{id}',[GetCommentUserController::class,'getCommentIsUserId']);
    Route::get('get-posts-categories/{id}',[GetPostIsCategoryController::class,'getPostCategory']);
    Route::get('logout',[AuthAdminController::class,'logoutAdmin']);
    Route::resource('admin-manager',AdminManagerController::class);

});
Route::group(['prefix'=>'admin','middleware'=>'checkAdmin'],function () {
    Route::get('admin-change-pw',[AdminManagerController::class,'changePwIndex']);
    Route::post('update-pw-admin',[AdminManagerController::class,'changePw']);
});
Route::prefix('/')->group(function () {
    Route::resource('home', HomeController::class);
    Route::resource('user-info', UserDetailController::class);
    Route::post('push-comment',[CommentController::class,'pushComment']);
    Route::get('/user-change-password',[UserDetailController::class,'changeUserPassword']);
    Route::post('/update-password',[UserDetailController::class,'updateUserPassword']);
    Route::get('/comment-is-user/{u_id}',[UserDetailController::class,'getCommentIsUser']);
    Route::get('/posts-by-category/{id}',[HomeController::class,'getPostByCategory']);
    Route::get('/posts-by-category-chil/{parent_id}',[HomeController::class,'getPostByCategoryParent']);
    Route::get('/search-posts',[HomeController::class,'searchPosts']);
});
Route::group(['middleware' => ['guest']], function() {
    Route::view('/user-register', 'user/auth/register');
    Route::view('/user-login', 'user/auth/login');
    Route::post('/user_register',[RegisterUserController::class,'user_register']);
    Route::post('/user-login',[RegisterUserController::class,'userAuthentication']);
    Route::view('/forgot-password', 'user/auth/forgotpw');
    Route::post('/change-pw',[ForgetPasswrodController::class,'checkUserForgetPw']);
    Route::post('/reset-password',[ForgetPasswrodController::class,'changePw']);
 });
Route::delete('/destroy-comment/{id}',[CommentController::class,'destroyComment']);
//Route::group(['middleware' => ['guest:admin','prefix'=>'admin','as'=>'admin']], function() {
//    Route::get('register',)
//});
Route::group(['middleware' => ['auth']], function() {
    Route::get('/logout',[LogoutController::class,'perform']);
 });

Route::view('login-admin','admin/auth/login');
Route::post('login-admin',[AuthAdminController::class,'loginAdmin']);

