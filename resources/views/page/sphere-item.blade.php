@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs-sphere')

        <h1 class="title-h1">{{ $page->name }}</h1>

        <div class="products__wrap ">
            @foreach ($page->categories as $item)
                @include('blocks.card-category')    
            @endforeach
        </div>        
        <div class="text">
            {!! $page->text !!}
        </div>
        
        @include('blocks.table')

        @include('blocks.examples')
        @include('blocks.banner')
    </div>

@endsection
