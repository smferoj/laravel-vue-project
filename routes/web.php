<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ApplicationController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('admin/dashboard', function(){
//  return view('dashboard');
// } );

Route::get('/api/users', [UserController::class, 'Index']);
Route::post('/api/users', [UserController::class, 'Store']);

Route::get('{view}', ApplicationController::class)->where('view', '(.*)');