<section class="services">
    <div class="container">
        <h2 class="services__title">Услуги</h2>
        @if($services->count())
            <div class="services__list">
                <div class="services__item service__item--big">
                    <h3 class="service__title service__title--big">
                        <a href="/" >{!! last_word_with_arrow($services->first()->name) !!}</a>
                    </h3>

                    <?php $texts = explode(PHP_EOL, $services->first()->text_on_main) ?>

                    @if(count($texts) > 1)
                        @foreach($texts as $text)
                            <div class="service__item">{{ $text }}</div>
                        @endforeach
                        <br>
                    @else
                        <p>{{ $texts[0] }}</p>
                    @endif

                    <a href="#" class="btn service__btn">
                        <span>Смотреть примеры работ <span class="arrow"></span></span>
                    </a>
                </div>

                @foreach($services->splice(1)->chunk(2) as $chunk)
                    <div class="services__wrap">
                        @foreach($chunk as $service)
                            <div class="services__item">
                                <h3 class="service__title">
                                    <a href="/" >{!! last_word_with_arrow($service->name) !!}</a>
                                </h3>

                                <?php $texts = explode(PHP_EOL, $service->text_on_main) ?>

                                @if(count($texts) > 1)
                                    @foreach($texts as $text)
                                        <div class="service__item">{{ $text }}</div>
                                    @endforeach
                                    <br>
                                @else
                                    <p>{{ $texts[0] }}</p>
                                @endif

                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
