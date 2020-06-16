<?php

ini_set("session.use_cookies", 1);
session_start();

use Illuminate\Support\Facades\Route;

//main page register
Route::get('/index', 'IndexController@index');

Route::get('/quit', 'IndexController@closeSession');

Route::get('/', 'IndexController@index');

Route::post('/generate', 'IndexController@generate');
