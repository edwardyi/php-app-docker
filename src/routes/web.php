<?php

Route::view('blogs', 'press::test'); // two collon for accessing package's test view

Route::get('/test', 'TestController@index');
// Route::get('/test', 'edwardyi/Press/Http/Controllers/TestController@index');