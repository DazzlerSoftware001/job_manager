<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\HomeController;

require base_path('routes/admin.php');
require base_path('routes/recruiter.php');

Route::get('/', [HomeController::class, 'Home'])->name('User.Home');