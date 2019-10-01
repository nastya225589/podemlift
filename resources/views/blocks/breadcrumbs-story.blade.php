<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__link">
            <a href="/">Главная</a>&nbsp;
        </li>

        @php($storyPage = \App\Models\Page::where('behavior', 'story')->first())
        @php($parent = $storyPage->parent)

        @include('blocks.breadcrumbs-parent')

        <li class="breadcrumbs__link">
            <a href="{{ $storyPage->url }}">{{ $storyPage->name }}</a>
        </li>

        <li class="breadcrumbs__link breadcrumbs__link-active">{{ $page->name }}</li>
    </ul>
</div>
