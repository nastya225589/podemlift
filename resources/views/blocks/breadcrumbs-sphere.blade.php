<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__link">
            <a href="/">Главная</a>&nbsp;
        </li>

        @php($spherePage = \App\Models\Page::where('behavior', 'sphere')->first())
        @php($parent = $spherePage->parent)

        @include('blocks.breadcrumbs-parent')

        <li class="breadcrumbs__link">
            <a href="{{ $spherePage->url }}">{{ $spherePage->name }}</a>
        </li>

        <li class="breadcrumbs__link breadcrumbs__link-active">{{ $page->name }}</li>
    </ul>
</div>
