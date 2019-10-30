@php ($serviceCategories = \App\Models\ServiceCategory::all())

<section class="services-page">
    @foreach ($serviceCategories as $category)
        <div class="services-page__wrap" style="background-image: url(/images/bg/service_bg_1.jpg);">
            <div class="services-page__title title-h2">{{ $category->name }}</div>
            <div class="services-page__inner">
                @foreach ($category->services as $item)
                    <a href="/services-item/{{ $item->slug }}" class="services-page__link">
                        <span class="title-h3">{{ $item->name }}</span>
                        <p class="text">{{ $item->introtext }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
</section>
