@php ($imageBlocks = $page->collection('imageBlock'))
<section class="about-card">
    <div class="about-card__list">
        @foreach ($imageBlocks as $item)
            <div class="about-card__item">
                <div class="about-card__desc">
                    <div class="about-card__name">
                        <div class="about-card__icon">
                            <img src="{{ $item->iconUrl }}" alt="" class="about-card__icon-img">
                        </div>
                        <h3 class="about-card__title title-h3">{{ $item->title }}</h3>
                    </div>
                    <div class="about-card__text text">
                        {!! $item->text !!}
                    </div>
                    <div class="about-card__value">
                        @if ($item->value)
                            <span class="about-card__value-number">{{ $item->value }}</span>
                        @endif
                        @if ($item->description)
                            <span class="about-card__value-text">{{ $item->description }}</span>
                        @endif
                    </div>
                </div>
    
                <div class="about-card__photo">
                    <img src="{{ $item->imgUrl }}" alt="" class="about-card__img">
                </div>
            </div>
        @endforeach
    </div>
</section>
