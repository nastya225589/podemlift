<section class="info">
    <div class="info__list">
        @foreach ($page->childrens as $item)
            <a href="{{ $item->url }}" class="info__item">
                <div class="info__icon">
                    @if ($item->image('icon')->url)
                        <img src="{{ $item->image('icon')->url }}" alt="">
                    @else
                        <svg width="50" height="50" >
                            <use xlink:href="images/icon/sprite.svg#production"></use>
                        </svg>
                    @endif
                </div>
                <span>{{ $item->name }}</span>
            </a>   
        @endforeach
    </div>
</section>
