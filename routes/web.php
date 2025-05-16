<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', [homeController::class, 'index']);

Route::get('/mahasiswa', [MahasiswaController::class, 'index'])->name('mahasiswa');
Route::group(['middleware'=>'auth'], function() {
Route::get('/mahasiswa/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
Route::get('/mahasiswa/edit/{id}', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
Route::post('/mahasiswa/store', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
Route::put('/mahasiswa/update/{id}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
Route::delete('/mahasiswa/destroy/{id}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
});

Route::get('/about', function() {
    return view('about');
});

// For user ID
// Route::get('/user/{id}', function($id) {
//     echo "User ID:" . $id;
// });

// For user name
Route::get('/user/{name?}', function ($name = 'Martin') {
    echo "Hello, " . $name;
});

// Mult parameters
Route::get('/posts/{post}/comments/{comment}', function($postId, $commentId) {
    echo "Post ID: " . $postId . ', Comment ID: ' . $commentId;
});

// Parameters with constraints
Route::get('/userRestrict/{id}', function($id) {
    echo "User ID: " . $id;
})->where('id', '[0-9]+'); // Only numbers


Auth::routes();

Route::get('/home', [App\Http\Controllers\homeController::class, 'index'])->name('home');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
