<section class="services">
    <div class="container">
        <h2 class="services__title">Услуги</h2>
        <div class="services__list">
            <div class="services__item service__item--big">
                <h3 class="service__title service__title--big">
                    <a href="/" >{{ $services->first()->name }}</a>
                </h3>

                <p>{{ $services->first()->introtext }}</p>

                <button class="btn service__btn">
                    <span>Смотреть примеры работ</span>
                </button>
            </div>

            @foreach($services->splice(1)->chunk(2) as $chunk)
                <div class="services__wrap">
                    @foreach($chunk as $service)
                        <div class="services__item">
                            <h3 class="service__title">
                                <a href="/" >{{ $service->name }}</a>
                            </h3>
                            <p>{{ $service->introtext }}</p>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
</section>
