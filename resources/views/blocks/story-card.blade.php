<div class="story-card">
    <h1 class="story-card__name title-h3">{{ $page->name }}</h1>

    <div class="story-card__photo">
        <img src="{{ $page->image->url }}" alt="" class="story-card__img">
    </div>
    
    <div class="story-card__desc text">
        {!! $page->text !!}
    </div>
</div>
