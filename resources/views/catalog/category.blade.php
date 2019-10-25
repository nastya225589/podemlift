@extends('layouts.app')

@section('data-page', 'catalog')

@section('content')
    <div class="container">
        <div class="catalog">

            <div class="catalog__title title-h1">{{ $page->name }}</div>

            <button class="btn btn-dashed catalog__btn-dashed_filter">Фильтр</button>

            @include('blocks.catalog-menu')

            <div class="catalog__wrap">

                @include('blocks.breadcrumbs-catalog')

                @include('blocks.filter-sorter')

                <div class="catalog__inner">
                    <div class="catalog__name title-h2">Все {{ $page->name }}</div>
                    @include('blocks.sorting-view')

                    <div class="catalog__list">
                        <div class="products__wrap {{ UserConfig::catalogListingInline() ? 'products__sorting-view' : '' }}">
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
    <section class="features">
        <div class="container">
            @builder($page->content, 'category')
        </div>
    </section>
    <section class="portfolio portfolio-card">
        <section class="examples">
            <div class="container">
                <div class="container">
                    <div class="examples__list">
                        @foreach ($page->images() as $item)
                            <div class="examples__item">
                                <img style="min-width: 180px" src="{{ $item->size(180, 300)->url }}" alt="photo" class="examples__photo" width="180" height="300">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </section>

    @include('blocks.examples')

@endsection
