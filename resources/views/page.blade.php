@extends('nova-cms::layouts.default')

@section('title', @$page->title)
@section('description', @$page->description)
@section('og_title', @$page->content->og_title)
@section('og_description', @$page->content->og_description)
@section('og_image', @$page->content->og_image)

@section('content')
    @if (isset($page->content['blocks']))
        @foreach ($page->content['blocks'] as $block)
            @include('nova-cms::components.' . $block['component'], ['block' => $block])
        @endforeach
    @endif
@endsection
