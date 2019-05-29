<section class="examples">
    <div class="container">
        <h2 class="examples__title">Примеры работ</h2>
        <div class="examples__list">
            @foreach($works as $work)
                <div class="examples__item">
                    <img src="{{ $work->firstImage()->size(180, 300)->url }}" alt="photo" class="examples__photo" width="180" height="300">
                    <p class="examples__desc">
                        {{ $work->introtext ?: $work->name }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>
