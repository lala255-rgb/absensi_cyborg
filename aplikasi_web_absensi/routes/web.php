<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\absensiController;
use App\Http\Controllers\mentorController;
use App\Models\absensi;

route::resource('siswas',siswaController::class);
route::resource('absensis',absensiController::class);
route::resource('mentors',mentorController::class);

Route::get('/', function () {
    return view('welcome');
});


