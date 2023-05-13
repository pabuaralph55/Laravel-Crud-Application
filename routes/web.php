<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DataRecordsController;
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

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [DataRecordsController::class, 'index'])->name('data_records.index');
Route::get('/create', [DataRecordsController::class, 'create'])->name('data_records.create');
Route::post('/store', [DataRecordsController::class, 'store'])->name('data_records.store');
Route::get('/{id}/edit', [DataRecordsController::class, 'edit'])->name('data_records.edit');
Route::put('/{id}/update', [DataRecordsController::class, 'update'])->name('data_records.update');
Route::post('/{id}/delete', [DataRecordsController::class, 'destroy'])->name('data_records.destroy');
Route::get('/search', [DataRecordsController::class, 'search'])->name('data_records.search');