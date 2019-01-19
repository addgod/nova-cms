<?php

namespace Addgod\NovaCms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'status',
        'order',
        'scheduled_at',
    ];

    protected $dates = [
        'scheduled_at',
    ];

    protected $casts = [
        'content' => 'object',
    ];

}
