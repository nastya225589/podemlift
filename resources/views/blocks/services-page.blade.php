@php
    $serviceCategories = \App\Models\ServiceCategory::all();
@endphp

<section class="services-page">
    @foreach ($serviceCategories as $category)
        @php
            switch ($category->name) {
                case 'Разработка и монтаж':
                    $background = '/images/bg/service_bg_1.jpg';
                    break;
                case 'Обслуживание и модернизация':
                    $background = '/images/bg/service_bg_2.jpg';
                    break;
                case 'Ремонт и реставрация':
                    $background = '/images/bg/service_bg_3.jpg';
                    break;
                case 'Консультация и экспертиза':
                    $background = '/images/bg/service_bg_4.jpg';
                    break;
                
                default:
                    $background = '/images/bg/service_bg_1.jpg';
                    break;
            }  
        @endphp
        <div class="services-page__wrap" style="background-image: url({{ $background }});">
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
