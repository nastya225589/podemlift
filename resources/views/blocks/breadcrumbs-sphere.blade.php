<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__link">
            <a href="/">Главная</a>&nbsp;
        </li>

        @php($spherePage = \App\Models\Page::where('behavior', 'sphere')->first())
        @php($parent = $spherePage->parent)

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
                <a href="{{ $spherePage->url }}">{{ $spherePage->name }}</a>
            </li>

        <li class="breadcrumbs__link breadcrumbs__link-active">{{ $page->name }}</li>
    </ul>
</div>
