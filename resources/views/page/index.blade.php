@extends('layouts.app')

@section('content')
    @include('blocks.promo')
    @include('blocks.about')
    @include('blocks.products')
    @include('blocks.services')
    @include('blocks.work')
    <section class="form">
        <div class="container">
            @include('blocks.form')
        </div>
    </section>
    @include('blocks.examples')
    @include('blocks.clients')
    @include('blocks.seo-text')
@endsection
