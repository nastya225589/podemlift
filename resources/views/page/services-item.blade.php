@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs-service')

        <h1 class="title-h1">{{ $page->name }}</h1>

        {!! $page->text !!}
        
    </div>

@endsection
