<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__link">
            <a href="/">Главная</a>&nbsp;
        </li>

        @php($portfolioPage = \App\Models\Page::where('behavior', 'portfolio')->first())
        @php($parent = $portfolioPage->parent)

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
                <a href="{{ $portfolioPage->url }}">{{ $portfolioPage->name }}</a>
            </li>

        <li class="breadcrumbs__link breadcrumbs__link-active">{{ $page->name }}</li>
    </ul>
</div>
