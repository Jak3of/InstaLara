<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
// use App\Models\Image;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!

|   Pruebas echas :

    $images = Image::all();
    foreach ($images as $image) {
        // code...

        echo '<hr>';
        echo $image->image_path.'<br>';
        echo $image->description.'<br>';
        $name =$image->user->name;
        $surname = $image->user->surname;
        echo "$name $surname <br>";


        echo "<strong> ". count($image->comments)." Comentarios</strong><br>";
        foreach ($image->comments as $comment){
            echo $comment->user->name.' dice: '.$comment->content.'<br>';

        }
        echo "<br> <br>";

        echo "<strong> Likes: ".count($image->likes)."</strong>";


    }
    echo '<hr>';
*/

Route::get('/laravel', function () {
    
    return view('welcome');
});



Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();



Route::group(['prefix'=> 'user'], function() {
    Route::get('/users/{search?}', [UserController::class , 'users'])->name('user.users');
    Route::post('/update', [UserController::class , 'update'])->name('user.update');
    Route::get('/avatar/{filename}', [UserController::class , 'getImage'])->name('user.avatar');
    Route::get('/like', [UserController::class , 'like'])->name('user.like');
    Route::get('/me', [UserController::class , 'profile'])->name('user.me');
});

Route::get('/configuracion', [App\Http\Controllers\UserController::class , 'config'])->name('config');

Route::group(['prefix'=> 'image'], function() {
    Route::get('/subir-imagen', [App\Http\Controllers\ImageController::class , 'create'])->name('image.create');
    Route::post('/save', [App\Http\Controllers\ImageController::class , 'save'])->name('image.save');
    Route::get('/{id}', [App\Http\Controllers\ImageController::class , 'getImage'])->name('image.get');
    Route::get('/detalle/{id}', [App\Http\Controllers\ImageController::class , 'detail'])->name('image.detail');
    Route::get('/delete/{id}', [App\Http\Controllers\ImageController::class , 'delete'])->name('image.delete');
    Route::get('/editar/{id}', [App\Http\Controllers\ImageController::class , 'edit'])->name('image.edit');
    Route::post('/update/{id}', [App\Http\Controllers\ImageController::class , 'update'])->name('image.update');
    
    
});



Route::group(['prefix'=> 'comment'], function() {
    Route::post('/save/{id}', [App\Http\Controllers\CommentController::class , 'save'])->name('comment.save');
    Route::get('/delete/{id}', [App\Http\Controllers\CommentController::class , 'delete'])->name('comment.delete');
    
    
    
});


Route::get('/{id}', [App\Http\Controllers\UserController::class , 'profiles'])->name('user.profiles');


