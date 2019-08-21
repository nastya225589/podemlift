<div class="features__name">
    @if(isset($content->imgUrl))
        <img class="features__img" src="{{ $content->imgUrl }}" alt="">
    @endif
    <h3 class="title-h3">{{ isset($content->title) ? $content->title : ''  }}</h3>
</div>
