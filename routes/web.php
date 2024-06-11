<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\DashController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\TestiController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\isAdmin;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');

Route::get('/loans', function () {
    return view('loans');
})->middleware(['auth', 'verified'])->name('loans');

Route::get('/fines', function () {
    return view('fines');
})->middleware(['auth', 'verified'])->name('fines');

Route::get('/message', function () {
    return view('message');
})->middleware(['auth', 'verified'])->name('message');

Route::get('/admin', function () {
    return view('admin');
})->middleware(['auth', 'verified', isAdmin::class])->name('admin');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
////////////////////////////////////////////////////////////////////////

//DASHBOARD VARIABLES
Route::get('/dashboard', [DashController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

//ADMIN CRUD ROUTE
Route::post('/books', [AdminController::class, 'create']);
Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth', 'verified', isAdmin::class])->name('admin');
Route::delete('/delete/{book}', [AdminController::class, 'destroy']);
Route::patch('/edit/{book}', [AdminController::class, 'update']);
Route::patch('/trends/{id}', [AdminController::class, 'trends']);
Route::patch('/canceltrends/{id}', [AdminController::class, 'canceltrends']);
Route::patch('/recommends/{book}', [AdminController::class, 'recommends']);
Route::patch('/cancelrecommends/{book}', [AdminController::class, 'cancelrecommends']);

//BOOK
Route::get('/home', [BookController::class, 'index'])->middleware(['auth', 'verified'])->name('home');
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::get('/viewloan/{id}', [BookController::class, 'showLoanPage']);

//LOANS
Route::post('/makeloan', [LoanController::class, 'create']);
Route::get('/loans', [LoanController::class, 'index'])->middleware(['auth', 'verified'])->name('loans');

//MESSAGE
Route::post('/add_message', [AdminController::class, 'send_message']);
Route::get('/message', [MessageController::class, 'index'])->name('message');
Route::post('/read_message/{id}', [MessageController::class, 'read_message']);

//TESTIMONY
Route::post('/testimony/{id}', [TestiController::class, 'add_testi']);
Route::patch('/edit_testimony/{id}', [TestiController::class, 'edit_testi']);
Route::get('/delete_testimony/{id}', [TestiController::class, 'delete_testi']);

require __DIR__ . '/auth.php';
