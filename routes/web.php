<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Laravel\Nova\Nova;

Route::get('{slug?}', 'PageController@show')
    ->where('slug', '((?!' . Str::substr(Nova::path(), 1, -1) . '|nova)[A-z\d\-\/_.]+)?')
    ->name('page.show');
