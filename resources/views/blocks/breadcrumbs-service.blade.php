<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__link">
            <a href="/">Главная</a>&nbsp;
        </li>

        @php($servicePage = \App\Models\Page::where('behavior', 'services')->first())
        @php($parent = $servicePage->parent)

        @include('blocks.breadcrumbs-parent')

        <li class="breadcrumbs__link">
            <a href="{{ $servicePage->url }}">{{ $servicePage->name }}</a>
        </li>

        <li class="breadcrumbs__link breadcrumbs__link-active">{{ $page->name }}</li>
    </ul>
</div>
