<?php /** @var $page \App\Models\ProductCategory */ ?>

<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__link">
            <a href="/">Главная</a>&nbsp;
        </li>

        @php($newsPage = \App\Models\Page::where('behavior', 'news')->first())
        @php($parent = $newsPage->parent)

        @while ($parent)
            @prepend('breadcrumbs')
                <li class="breadcrumbs__link">
                    <a href="{{ $parent->url }}">{{ $parent->name }}</a>
                </li>
            @endprepend
            @php($parent = $parent->parent)
        @endwhile

        @stack('breadcrumbs')

        <li class="breadcrumbs__link">
                <a href="{{ $newsPage->url }}">{{ $newsPage->name }}</a>
            </li>

        <li class="breadcrumbs__link breadcrumbs__link-active">{{ $page->name }}</li>
    </ul>
</div>
