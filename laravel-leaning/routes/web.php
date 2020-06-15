<?php

ini_set("session.use_cookies", 1);
session_start();

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

//main page register
Route::get('/', function () {
    if(!isset($_COOKIE['uuid']))
        return view('index');

    return view('index2');
});

Route::get('/quit', function () {
    if(!isset($_COOKIE['uuid']))
        return view('index');

    unset($_COOKIE['uuid'], $_COOKIE['uuid-time']);
    return view('index');
});

Route::get('/index', function () {
    if(!isset($_COOKIE['uuid']))
        return view('index');

    return view('index2');

});

Route::post('/generate', function () {

    /*
     * UUID generator
     */
    setcookie('uuid', Str::uuid()->toString(), time()+60*60*12, '/', null);
    setcookie('uuid-time', time()+60*60, time()+60*60*12, '/', null);

    return redirect('index');
});
