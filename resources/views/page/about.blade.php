@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs')

        <h1 class="title-h1">{{ $page->name }}</h1>

        @include('blocks.about-card')
        @include('blocks.directions')
    </div>

    @include('blocks.get-free')

    <div class="container">
        @include('blocks.advantages')
        @include('blocks.work')
        <div class="text">
            {!! $page->content !!}
        </div>
    </div>

    @include('blocks.services')
    @include('blocks.examples')

    <div class="container">
        @include('blocks.banner')
    </div>

@endsection
