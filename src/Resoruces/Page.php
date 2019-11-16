<?php

namespace Addgod\NovaCms\Resources;

use Addgod\ComponentField\ComponentField;
use Addgod\NovaTranslateField\Translate;
use App\Nova\Resource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;

abstract class Page extends Resource
{
    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'CMS';

    /**
     * The locales that are used.
     *
     * @var array
     */
    public static $locales = ['en', 'da'];

    /**
     * The default locale, that the system uses.
     *
     * @var string
     */
    public static $defaultLocale = 'en';

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
    public static $displayInNavigation = true;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'Page';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'slug',
    ];

    /**
     * Metadata
     *
     * @var \Addgod\ComponentField\ComponentField
     */
    protected $metadata;

    /**
     * Content
     *
     * @var \Addgod\ComponentField\ComponentField
     */
    protected $content;

    /**
     * Page constructor.
     *
     * @param \Illuminate\Database\Eloquent\Model $resource
     */
    public function __construct(Model $resource)
    {
        parent::__construct($resource);

        Translate::locales(static::$locales, static::$defaultLocale);

        $this->metadata = ComponentField::make('Metadata');
        $this->content = ComponentField::make('Content');
        $this->metadata($this->metadata);
        $this->content($this->content);
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     * @throws \Exception
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug')->rules('required', 'unique:pages,slug,{{resourceId}}')->sortable(),
            Select::make('Status')
                ->options([0 => 'Draft', 1 => 'Published', 2 => 'Live'])
                ->displayUsingLabels()
                ->rules('required'),
            DateTime::make('Publishing on', 'scheduled_at'),
            Translate::make([
                Text::make('Title')->rules('required'),
                $this->metadata->stacked(),
                $this->content->stacked(),
            ]),
            Text::make('Preview')
                ->withMeta([
                    'value' => '<a href="' . route('page.show', [
                            'locale' => static::$defaultLocale,
                            'slug'   => $this->slug,
                        ]) . '" target="_blank">Preview</a>',
                ])
                ->asHtml()
                ->onlyOnIndex(),
        ];
    }

    /**
     * Get all the components that are displayed by the resource.
     *
     * @param \Addgod\ComponentField\ComponentField $metadata
     *
     * @return void
     */
    abstract public function content(ComponentField $metadata): void;

    /**
     * Get all the metadata that can be used by this resource.
     *
     * @param \Addgod\ComponentField\ComponentField $content
     *
     * @return void
     */
    abstract public function metadata(ComponentField $content): void;
}
