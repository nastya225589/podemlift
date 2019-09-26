@extends('layouts.app')

@section('content')

    <div class="container">
        @include('blocks.breadcrumbs')

        <h1 class="title-h1">{{ $page->name }}</h1>

        {!! $page->text !!}

        <div class="products__wrap ">
            @foreach ($page->categories as $item)
                @include('blocks.card-category')    
            @endforeach
        </div>        
        
        @include('blocks.table')
        <h3 class="title-h3">Особенности и преимущества лифтов для денег в банках</h3>
        <p class="text">Современные устройства этой серии достаточно быстро монтируются (2-3 дня) и не требуют сложного, дорогостоящего сервисного обслуживания. Существует большое количество модификаций, которые имеют конструкцию с проходной или глухой кабиной, распашными или раздвижными дверцами, разной скоростью перемещения и т.д. Большой выбор решений позволяет установить в банк лифт, максимально отвечающий поставленным требованиям.</p>
        @include('blocks.list')
        @include('blocks.examples')
        @include('blocks.banner')
    </div>

@endsection
