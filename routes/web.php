<?php

use Illuminate\Support\Facades\Route;

Route::get('{slug?}', '\Addgod\NovaCms\Http\Controllers\PageController@show')
    ->where('slug', '((?!nova)[A-z\d-\/_.]+)?')
    ->name('page.show');
