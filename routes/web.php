<?php

use App\Http\Controllers\MainController;
use App\Http\Controllers\CreateController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;

use App\Http\Controllers\ListOfPostsController;

use App\Http\Controllers\TestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//use Illuminate\Support\Facades\Request;


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PostsController;
use App\Http\Controllers\LoginController;


use App\Models\Posts;
use \App\Http\Middleware\AdminCheck;

use Illuminate\Routing\RouteFileRegistrar;
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

// for user
Route::get('/', [MainController::class, 'index'])->name('welcome');
Route::get('/create', [CreateController::class, 'index'])->name('form');
Route::post('/create', [CreateController::class, 'create'])->name('create_form');
Route::get('/search',[SearchController::class, 'index'])->name('search_user');

Route::get('/login',[LoginController::class, 'index'])->name('login_form');
Route::post('/login',[LoginController::class, 'login'])->name('login');

Route::get('/registration',[RegisterController::class, 'index'])->name('registration_form');
Route::post('/registration', [RegisterController::class, 'registration'])->name('registration');


// for admin
Route::group(['middleware' => 'auth'/*'test'*/,'prefix' => 'admin'], function () {
    Route::resource('/posts', PostsController::class);
    Route::get('/search', [SearchController::class, 'index'])->name('search');
    Route::get('/test2', [TestController::class, 'index'])->name('test2');
   // Route::get('/test2', [TestController::class, 'index'])->name('test2');

});

/*
Route::get('create', [CreateController::class, 'index'])->name('form');
Route::post('create', [CreateController::class, 'create'])->name('create_form');
Route::get('edit/{id}', [EditController::class, 'index'])->name('edit_form_get');
Route::put('edit/{id}', [EditController::class, 'update'] )->name('edit_form_put');
Route::delete('delete/{id}',[EditController::class, 'destroy'])->name('delete');
*/

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::get('/errors_update', function () {
    return view('/errors_update');
})->name('errors_update');

// routs test
Route::get('/list_of_posts', [ListOfPostsController::class, 'index'])->name('list_of_posts');
/*
Route::get('/test2', function () {
    $obj =  new TestController;
    return $obj->index();
})->name('test2');
*/

Route::get('/test2', [TestController::class, 'index'])->name('test2');

Route::get('/test3', function () {
    /* $obj =  new TestController;
    return $obj->index();
    */
    //return response()->redirectTo( '/');
   // return response()->json(['name' => 'Sangeetha']);
    $content = ['name' => 'Sangeetha'];
    return response(json_encode($content))->withHeaders(['Content-Type' => 'application/json']);
})->middleware('test2')->name('test3');


Route::get('/test4', function (Request $request) {
    //$posts = DB::table('posts')->paginate(3);
   // return view('welcome', ['posts' => $posts]);
    //return response(Posts::all())->header('X-Greatness-Index', 12);
    //var_dump($request->header('Accept'));
    //var_dump($request->header('Accept'));
    return Posts::paginate(2);
})->name('test4');


Route::get('/test3', [TestController::class, 'test3'])->name('test3');
