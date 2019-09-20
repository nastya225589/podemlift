<?php /** @var $page \App\Models\ProductCategory */ ?>

<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__link">
            <a href="/">Главная</a>&nbsp;
        </li>
        @if($page->behavior !== 'catalog')
            @php($catalog = \App\Models\Page::where('behavior', 'catalog')->first())
            <li class="breadcrumbs__link">
                <a href="{{ $catalog->url }}">{{ $catalog->name }}</a>&nbsp;
            </li>
        @endif

        @php($parent = $page->parent)

        @while ($parent)
            @prepend('breadcrumbs')
                <li class="breadcrumbs__link">
                    <a href="{{ $parent->url }}">{{ $parent->name }}</a>
                </li>
            @endprepend
            @php($parent = $parent->parent)
        @endwhile

        @stack('breadcrumbs')

        <li class="breadcrumbs__link breadcrumbs__link-active">{{ $page->name }}</li>
    </ul>
</div>
