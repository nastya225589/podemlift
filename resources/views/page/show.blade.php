@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>{{ $page->name }}</h1>

        {!! $page->content !!}
    </div>

@endsection
