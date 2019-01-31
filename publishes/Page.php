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
     * @return array
     */
    public function metadata(): array
    {
        return [
            Text::make('Navigation title'),
        ];
    }

    /**
     * Get all the components that are displayed by the resource.
     *
     * @return array
     */
    public function components(): array
    {
        return [
            ComponentField::make('Hero', 'blocks')->fields([
                Markdown::make('Content')->rules('required'),
            ]),
        ];
    }
}
