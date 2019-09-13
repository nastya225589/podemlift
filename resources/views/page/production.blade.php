@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs')

        <h1 class="title-h1">{{ $page->name }}</h1>

        {!! $page->content !!}

        <p class="text">
            Наш опыт и квалификация позволяют подобрать для клиента оптимальное решение на основании его технико-экономических требований, оперативно изготовить, поставить и выполнить пуско-наладочные работы оборудования. Независимо от сложности проекта мы гарантируем оперативное и качественное выполнение всех взятых на себя обязательств, обеспечение заказчика современными, надежными и функциональными системами для подъёма и перемещения грузов.
        </p>

        @include('blocks.about-card')
    </div>

    @include('blocks.examples')

    <div class="container">
        @include('blocks.banner')
    </div>

@endsection
