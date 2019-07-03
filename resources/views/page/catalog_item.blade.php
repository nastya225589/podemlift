@extends('layouts.app')

@section('content')
    <div class="container">
        @include('blocks.breadcrumbs')
    </div>
    @include('blocks.product-card')
    @include('blocks.tabs')
@endsection
