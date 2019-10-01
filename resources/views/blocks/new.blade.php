<li class="news__item">
    <div class="news__photo">
        <img class="news__img" src="{{ $item->image->url }}" alt="">
    </div>
    <div class="news__desc">
        <a href="/new-card/{{ $item->slug }}" class="news__name">{{ $item->name }}</a>
        <span class="news__data">{{ $item->created_at }}</span>

        <p class="news__text text">{!! Str::limit(strip_tags($item->text), 300, '...') !!}</p>
    </div>
</li>
