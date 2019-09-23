@php ($settings = '\App\Models\Settings')
@php ($address = $settings::where('name', 'address')->first())
@php ($phone = $settings::where('name', 'phone')->first())
@php ($emailClients = $settings::where('name', 'email_clients')->first())
@php ($emailSuppliers = $settings::where('name', 'email_suppliers')->first())
<section class="map-contacts">
    <div class="map-contacts__list">
        <div class="map-contacts__item">
            {{--@include('blocks.logo')--}}
            <a class="logo" href="/">
                <svg width="398" height="85">
                    <use xlink:href="images/icon/sprite.svg#logo-green"></use>
                </svg>
            </a>
        </div>
        <div class="map-contacts__item">
            <svg width="43" height="43">
                <use xlink:href="images/icon/sprite.svg#map-map"></use>
            </svg>
            @if ($address)
                <div class="map-contacts__wrap">
                    <h3>Адрес:</h3>
                    <span>{{ $address->value }}</span>
                </div>
            @endif
        </div>
        <div class="map-contacts__item">
            <svg width="44" height="44">
                <use xlink:href="images/icon/sprite.svg#map-phone"></use>
            </svg>
            @if ($phone)
                <div class="map-contacts__wrap">
                    <h3>Телефон:</h3>
                <span><a href="tel:{{ $phone->value }}">{{ $phone->value }}</a></span>
                </div>
            @endif
        </div>
        <div class="map-contacts__item">
            <svg width="41" height="41">
                <use xlink:href="images/icon/sprite.svg#map-email"></use>
            </svg>
            <div class="map-contacts__wrap">
                <h3>Почта:</h3>
                @if ($emailClients)
                    <span><a href="mailto:{{ $emailClients->value }}">{{ $emailClients->value }}</a> — для заказчиков</span>
                @endif
                @if ($emailClients)
                    <span><a href="mailto:{{ $emailSuppliers->value }}">{{ $emailSuppliers->value }}</a> — для поставщиков</span>
                @endif
            </div>
        </div>
    </div>
</section>
