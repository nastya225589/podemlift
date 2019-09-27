@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs-service')

        <h1 class="title-h1">{{ $page->name }}</h1>
        
        <div class="text">
            {!! $page->text !!}
        </div>
        
    </div>

@endsection
