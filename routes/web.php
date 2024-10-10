<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Route::get('/ContactController', function index() {
//     return view('index');
// });


// use App\Http\Controllers\ContactController;

// Route::get('/', [ContactController::class, 'index']);
// Route::resource('contacts', ContactController::class);

// Route::view('contacts.index','/index');
// Route::get('contacts/index', [ContactController::class,'index'])->name('contacts');
// Route::post('contacts/create', [ContactController::class,'create'])->name('contacts');
// Route::post('contacts/update/{id}', [ContactController::class,'update'])->name('contacts');
// Route::get('contacts/delete/{id}', [ContactController::class,'destroy'])->name('contacts');


Route::get("/", [ContactController::class, 'index'])->name('contacts.index');
Route::get("/create", [ContactController::class, 'create'])->name('contacts.create');
Route::post('/store', [ContactController::class,'store'])->name('contacts.store');
Route::get('/{contact}/edit/', [ContactController::class,'edit'])->name('contacts.edit'); 
Route::post('/update/{contact}', [ContactController::class,'update'])->name('contacts.update');
Route::delete('/destroy/{contact}', [ContactController::class,'destroy'])->name('contacts.destroy');
Route::get('/contact/modal', [ContactController::class,'modal'])->name('contacts.modal');
