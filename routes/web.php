<?php

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Nova;

Route::get('{slug?}', '\Addgod\NovaCms\Http\Controllers\PageController@show')
    ->where('slug', '((?!' . Nova::path() . ')[A-z\d-\/_.]+)?')
    ->name('page.show');
