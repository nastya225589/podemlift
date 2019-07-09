@extends('layouts.app')

@section('content')
    <div class="line"></div>
    <div class="container">
        <div class="catalog">
            <h1 class="catalog__title">Подъемник грузовой одномачтовый, грузоподъемность 250 кг</h1>
            <button class="btn btn-dashed catalog__btn-dashed_filter">Фильтр</button>
            @include('blocks.catalog-menu')

            <div class="catalog__wrap">
                <div class="breadcrumbs">
                    @include('blocks.breadcrumbs')
                </div>

                @include('blocks.filter-sorter')

                <div class="catalog__inner">

                    <div class="catalog__name">Все трособлочные подъемники</div>
                    @include('blocks.sorting-view')

                    <div class="catalog__list">
                        <?php $products = \App\Models\Product::all() ?>
                        <div class="products__wrap">
                            @foreach($products as $product)
                                @include('blocks.card')
                            @endforeach
                        </div>
                    </div>
                    <button class="btn btn-dashed catalog__btn-dashed">Показать еще</button>
                    @include('blocks.pagination')
                </div>
            </div>

        </div>
    </div>
    @include('blocks.features')

    <?php
        $works = \App\Models\Work::inRandomOrder()->limit(10)->get();
        while ($works->count() < 5) {
            $more = \App\Models\Work::inRandomOrder()->limit(10)->get();
            $works = collect(array_merge($works->all(), $more->all()));
        }
    ?>
    @include('blocks.examples')

@endsection
