<?php

namespace App\Nova;

use Addgod\ComponentField\ComponentField;
use Addgod\NovaCms\Resources\Page as NovaPage;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;

class Page extends NovaPage
{

    /**
     * The locales that are used.
     *
     * @var array
     */
    public static $locales = ['en'];

    /**
     * The default locale, that the system uses.
     *
     * @var string
     */
    public static $defaultLocale = 'en';

    /**
     * Get all the metadata that can be used by this resource.
     *
     * @param \Addgod\ComponentField\ComponentField $metadata
     *
     * @return void
     */
    public function metadata(ComponentField $metadata): void
    {
        $metadata->addSection('Meta fields', 'meta_fields', [
            Text::make('Navigation title'),
        ], 1);
    }

    /**
     * Get all the components that are displayed by the resource.
     *
     * @param \Addgod\ComponentField\ComponentField $content
     *
     * @return void
     */
    public function content(ComponentField $content): void
    {
        $content->addSection('Hero', 'hero', [
            Markdown::make('Content')->rules('required'),
        ], 1);
    }
}
