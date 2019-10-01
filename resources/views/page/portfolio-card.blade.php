@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs-portfolio-card')

        <h1 class="title-h1">{{ $page->name }}</h1>

        {!! $page->content !!}

        @include('blocks.portfolio-card')
    </div>

@endsection
