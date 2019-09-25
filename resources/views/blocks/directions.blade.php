@php ($icons = $page->collection('icons'))
<section class="directions">
    <h2 class="title-h2 directions__title">Основные направления нашей деятельности</h2>
    <div class="directions__list">
        @foreach ($icons as $item)
            <div class="directions__item">
                <div class="directions__photo">
                    <img src="{{ $item->imgUrl }}" alt="" class="directions__img">
                </div>
                <span class="directions__name">{{ $item->title }}</span>
            </div>
        @endforeach
    </div>
</section>
