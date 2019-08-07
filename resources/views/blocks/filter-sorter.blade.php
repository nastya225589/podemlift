<div class="filter-sorter">
    <h1 class="filter-sorter__title title-h1">{{ $page->name }}</h1>
    @if($page->childrens()->count())
        <ul class="filter-sorter__list">
            @foreach($page->childrens as $child)
                <li class="filter-sorter__item">
                    <a href="{{ $child->url }}">
                        {{ $child->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
