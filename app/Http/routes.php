<?php

use Illuminate\Support\Facades\Route;

//Route::get('/home', function () {
//    return view('home.home');
//});

Route::get('dashboard', function () {
    return view('dashboard.dashboard');
});

Route::controller('dashboard', 'DashboardController');

Route::controller('account', 'AccountController');

Route::controller('booking', 'BookingController');

Route::controller('shop', 'ProductController');

Route::controller('contact', 'ContactController');

Route::controller('/home', 'HomeController');

Route::controller('invoice', 'InvoiceController');
Route::controller('user', 'UserController');
