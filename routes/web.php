<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CandidatController;

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

Route::get('/',[HomeController::class, 'index'])->name("home");


Route::resource('categorie', CategorieController::class);
Route::resource('candidat', CandidatController::class);
Route::resource('note', NoteController::class);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

//Route::get('/', [HomeController::class,'allCandidat'])->name("note");
//Route::post('/noter', [HomeController::class,'noter'])->name("store.note");

//Route::post('/note', [HomeController::class,'candidatByCategorie'])->name("candidatByCategorie");

Route::get('/liste/note', [NoteController::class,'index'])->name("liste.note");

Route::post('/rts', [HomeController::class,'rtsByCategorie'])->name("rtsByCategorie");

Route::resource('user', UserController::class)->middleware(['auth'/*,'admin'*/]);

Route::get('/modifier/motdepasse',[UserController::class,'modifierMotDePasse'])->name("modifier.motdepasse")->middleware(['auth']);
Route::post('/update/password',[UserController::class,'updatePassword'])->name("user.password.update")->middleware(['auth']);//->middleware(["auth","checkMaxSessions"]);
