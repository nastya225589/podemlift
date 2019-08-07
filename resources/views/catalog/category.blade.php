@extends('layouts.app')

@section('content')
    <div class="line"></div>
    <div class="container">
        <div class="catalog">

            <div class="catalog__title title-h1">{{ $page->name }}</div>

            <button class="btn btn-dashed catalog__btn-dashed_filter">Фильтр</button>

            @include('blocks.catalog-menu')

            <div class="catalog__wrap">

                @include('blocks.breadcrumbs')

                @include('blocks.filter-sorter')

                <div class="catalog__inner">
                    <div class="catalog__name title-h2">Все {{ $page->name }}</div>

                    @include('blocks.sorting-view')

                    <div class="catalog__list">
                        <div class="products__wrap">
                            @foreach($products as $product)
                                @include('blocks.card')
                            @endforeach
                        </div>
                    </div>

                    <button class="btn btn-dashed catalog__btn-dashed">Показать еще</button>

                    {{ $products->links('blocks.pagination') }}

                </div>
            </div>

        </div>
    </div>

    @include('blocks.features')

    @include('blocks.examples')

@endsection
