@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs')

        <h1 class="title-h1">{{ $page->name }}</h1>

        {!! $page->content !!}
    </div>

    @include('blocks.map')

    <div class="container">
        @include('blocks.requisites')
        @include('blocks.office')
        @include('blocks.form-question')
    </div>


@endsection
