<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route aplikasi ToDo:
| - Halaman utama menampilkan daftar ToDo.
| - Form untuk menambah ToDo.
| - Tombol selesai/tidak selesai.
| - Tombol hapus.
|
*/

Route::get('/', [TodoController::class, 'index'])->name('home');

// tambah todo baru
Route::post('/todo/add', [TodoController::class, 'store'])->name('todo.add');

// ubah status selesai / belum selesai
Route::get('/todo/{id}/toggle', [TodoController::class, 'toggle'])->name('todo.toggle');

// hapus todo
Route::delete('/todo/{id}', [TodoController::class, 'destroy'])->name('todo.delete');
