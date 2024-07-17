<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



// Route::get('admin', function(){
//     return 'Hi Admin';
// })->middileware('role:admin');
// Route::get(admin['middleware' => ['role:admin']], function () { return 'hello'; });
// Route::get('admin', function(){
//     return 'Hi user';
// })->middileware('role:user');
// Route::get('admin', function () {
//     return'Hi admin';
// })->middleware(['role:admin']);
// Route::get('user', function () {
//     return'Hi admin';
// })->middleware(['role:user']);
Route::redirect('/', '/prototype/login');

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});




Route::prefix('prototype')->group(function(){
    route::get('/login', function(){
        return Inertia::render('/resources/js/Pages/Prototype/Login');
    });
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
