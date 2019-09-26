<div class="new-card">
    <h1 class="new-card__name title-h3">{{ $page->name }}</h1>
    <span class="new-card__data">{{ $page->created_at }}</span>

    <div class="new-card__desc text">
        {!! $page->text !!}
    </div>

    <div class="new-card__photo">
        <img src="{{ $page->image->size(1200)->url }}" alt="" class="new-card__img">
    </div>
</div>
