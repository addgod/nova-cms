<?php

namespace Addgod\NovaCms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use SoftDeletes;

    const DRAFT     = 0;
    const PUBLISHED = 1;
    const LIVE      = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'metadata',
        'content',
        'status',
        'order',
        'scheduled_at',
    ];

    /**
     * The attributes that should be mutated into dates.
     *
     * @var array
     */
    protected $dates = [
        'scheduled_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'metadata' => 'object',
        'content'  => 'object',
    ];

}
