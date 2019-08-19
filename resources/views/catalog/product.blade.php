@extends('layouts.app')

@section('data-page', 'product')

@section('content')
    <div class="line"></div>
    <div class="container">
        @include('blocks.breadcrumbs-product')
    </div>
    @include('blocks.product-card')
    @include('blocks.tabs')
@endsection
