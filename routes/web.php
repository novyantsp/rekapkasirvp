<?php

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

Route::get('/', App\Livewire\Sesis\Index::class)->name('sesis.index');
Route::get('/create', App\Livewire\Sesis\Create::class)->name('sesis.create');
Route::get('/edit/{id}', App\Livewire\Sesis\Detail::class)->name('sesis.detail');
