<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col">
            {!! Illuminate\Mail\Markdown::parse($teaser['content']) !!}
        </div>
        <div class="col">
            @foreach($teaser['images'] as $section)
                @includeIf('nova-cms::sections.' . $section['attribute'], [$section['attribute'] => $section['fields']])
            @endforeach
        </div>
    </div>
</div>
