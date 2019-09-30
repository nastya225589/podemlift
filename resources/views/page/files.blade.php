@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs')

        <h1 class="title-h1">{{ $page->name }}</h1>

        @foreach ($page->collection('files') as $item)
            @include('blocks.link-file')
        @endforeach

    </div>

@endsection
