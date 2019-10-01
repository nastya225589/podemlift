@php ($clients = \App\Models\Client::all())

<section class="clients-page">
    <div class="clients-page__list">
        @foreach ($clients as $item)
            <div class="clients-page__item">
                <div class="clients-page__photo">
                    <img src="{{ $item->image->path }}" alt="" class="clients-page__img">
                </div>
                <span class="clients-page__name">{{ $item->name }}</span>
            </div>
        @endforeach
    </div>
</section>
