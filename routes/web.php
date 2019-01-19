<?php

use Illuminate\Support\Facades\Route;

Route::any('{slug}', '\Addgod\NovaCms\Http\Controllers\PageController@show')
    ->where('slug', '((?!nova).[A-z\d-\/_.]+)?');
