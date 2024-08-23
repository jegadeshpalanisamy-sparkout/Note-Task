<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\SignUpController;
use Illuminate\Support\Facades\Route;

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
    return view('login');
})->name('login');


Route::get('/signup', [SignUpController::class, 'signUp'])->name('signup');
Route::post('/register', [SignUpController::class, 'store'])->name('register');
Route::post('/login', [LoginController::class, 'login'])->name('loginUser');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [LoginController::class, 'home'])->name('dashboard');
    Route::get('/notes/add', [NoteController::class, 'create'])->name('add-notes');
    Route::post('/notes/store', [NoteController::class, 'store'])->name('storeNotes');
    Route::get('/notes/edit/{id}', [NoteController::class, 'edit'])->name('editNote');
    Route::put('/notes/update/{id}', [NoteController::class, 'update'])->name('updateNote');
    Route::delete('/notes/delete/{id}', [NoteController::class, 'destroy'])->name('deleteNote');
});






