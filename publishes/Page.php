<?php

namespace App\Nova;

use Addgod\ComponentField\ComponentField;
use Illuminate\Http\Request;
use Infinety\Filemanager\FilemanagerField;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

class Page extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = "Addgod\NovaCms\Models\Page";

    /**
     * Hide resource from Nova's standard menu.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title', 'slug',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Title')->rules('required'),
            Text::make('Slug')->rules('required'),
            Select::make('Status')
                ->options([0 => 'Draft', 1 => 'Published', 2 => 'Live'])
                ->displayUsingLabels()
                ->rules('required'),
            DateTime::make('Publishing on', 'scheduled_at'),
            ComponentField::make('Metadata')->fields([
                Text::make('Navigation title'),
            ])->displayUsing(function ($value) {
                return json_encode($value, JSON_PRETTY_PRINT);
            }),
            ComponentField::make('Content')->fields([
                ComponentField::make('Hero', 'blocks')->fields([
                    Markdown::make('Content')->rules('required'),
                ]),
                ComponentField::make('Row', 'blocks')->fields([
                    Boolean::make('Wide'),
                    ComponentField::make('Column', 'columns')->fields([
                        ComponentField::make('Text', 'column')->fields([
                            Markdown::make('Content'),
                        ]),
                        ComponentField::make('Image', 'column')->fields([
                            FilemanagerField::make('file'),
                        ]),
                    ]),
                ]),
            ])->displayUsing(function ($value) {
                return json_encode($value, JSON_PRETTY_PRINT);
            }),
            Text::make('Preview')
                ->withMeta(['value' => '<a href="/' . $this->slug . '" target="_blank">Preview</a>'])
                ->asHtml()
                ->onlyOnIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
