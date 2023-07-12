<?php

use App\Http\Controllers\todo;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get(
    '/',
    [todo::class, 'index']
);
Route::post(
    '/insert',
    [todo::class, 'insert']
);
Route::delete(
    '/todo/{id}/delete',
    [todo::class, 'delete']
);
Route::put(
    '/todo/{id}/done',
    [todo::class, 'done']
);
