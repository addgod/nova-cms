@extends('nova-cms::layouts.default')

@section('title', @$page->title)
@section('description', @$page->description)
@section('og_title', @$page->content->og_title)
@section('og_description', @$page->content->og_description)
@section('og_image', @$page->content->og_image)

@section('content')
    @if (isset($page->content))
        @foreach ($page->content as $section)
            @includeIf('nova-cms::sections.' . $section['attribute'], [$section['attribute'] => $section['fields']])
        @endforeach
    @endif
@endsection
