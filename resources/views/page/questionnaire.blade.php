@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs')

        <h1 class="title-h1">{{ $page->name }}</h1>

        {!! $page->content !!}

        @include('blocks.form-poll')
    </div>

@endsection
