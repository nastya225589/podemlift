<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__link">
            <a href="/">Главная</a>&nbsp;
        </li>

        @php($portfolioPage = \App\Models\Page::where('behavior', 'portfolio')->first())
        @php($parent = $portfolioPage->parent)

        @include('blocks.breadcrumbs-parent')

        <li class="breadcrumbs__link">
            <a href="{{ $portfolioPage->url }}">{{ $portfolioPage->name }}</a>
        </li>

        <li class="breadcrumbs__link">
            <a href="/portfolio-item/{{ $page->category->slug }}">{{ $page->category->name }}</a>
        </li>

        <li class="breadcrumbs__link breadcrumbs__link-active">{{ $page->name }}</li>
    </ul>
</div>
