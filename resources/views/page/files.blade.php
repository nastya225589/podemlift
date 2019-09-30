@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs')

        <h1 class="title-h1">{{ $page->name }}</h1>
        <div class="text">
            {!! $page->content !!}
        </div>
        
        @foreach ($page->collection('files') as $item)
            @include('blocks.link-file')
        @endforeach

        @include('blocks.form-question')
    </div>

@endsection
