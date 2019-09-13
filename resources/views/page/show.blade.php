@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs')

        <h1 class="title-h1">{{ $page->name }}</h1>

        {!! $page->content !!}

        @include('blocks.about-card')
        @include('blocks.directions')
    </div>

    @include('blocks.get-free')

    <div class="container">
        @include('blocks.advantages')
        @include('blocks.work')
        <p class="text">
            Наш опыт и квалификация позволяют подобрать для клиента оптимальное решение на основании его технико-экономических требований, оперативно изготовить, поставить и выполнить пуско-наладочные работы оборудования. Независимо от сложности проекта мы гарантируем оперативное и качественное выполнение всех взятых на себя обязательств, обеспечение заказчика современными, надежными и функциональными системами для подъёма и перемещения грузов.
        </p>
    </div>

    @include('blocks.services')
    @include('blocks.examples')
    <div class="container">
        @include('blocks.banner')
        @include('blocks.table')
        @include('blocks.office')
        @include('blocks.form-question')
        @include('blocks.form-poll')
        @include('blocks.link-file')
        @include('blocks.requisites')
    </div>

@endsection
