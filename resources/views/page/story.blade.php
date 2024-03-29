@extends('layouts.app')

@section('content')

@php ($stories = \App\Models\Story::published()->paginate(12))
    <div class="container">
        @include('blocks.breadcrumbs')

        <h1 class="title-h1">{{ $page->name }}</h1>

        {!! $page->content !!}

        @include('blocks.stories')
        {{ $stories->links('blocks.pagination') }}
    </div>

@endsection
