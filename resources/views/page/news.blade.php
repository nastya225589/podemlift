@extends('layouts.app')

@section('content')

@php ($news = \App\Models\News::published()->paginate(12))
    <div class="container">
        @include('blocks.breadcrumbs')

        <h1 class="title-h1">{{ $page->name }}</h1>

        {!! $page->content !!}

        @include('blocks.news')
        {{ $news->links('blocks.pagination') }}
    </div>

@endsection
