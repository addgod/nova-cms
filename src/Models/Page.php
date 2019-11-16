<?php

namespace Addgod\NovaCms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use SoftDeletes;
    use HasTranslations;

    const DRAFT     = 0;
    const PUBLISHED = 1;
    const LIVE      = 2;

    public $translatable = [
        'content',
        'metadata',
        'title',
    ];

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
}
