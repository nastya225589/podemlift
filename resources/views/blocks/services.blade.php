<?php
    $services = \App\Models\Service::where('on_main', true)->published()->orderBy('order_on_main')->limit(4)->get();
?>
<section class="services">
    <div class="container">
        <div class="services__title title-h2">Услуги</div>
        @if($services->count())
            <div class="services__list">
                <div class="services__item service__item--big">
                    <h3 class="service__title service__title--big">
                        <a href="/services-item/{{ $services->first()->slug }}" >{!! last_word_with_arrow($services->first()->name) !!}</a>
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

                    @if ($portfolio = \App\Models\Page::where('behavior', 'portfolio')->first())
                        <a href="{{ $portfolio->url }}" class="btn btn__long-arrow">
                            <span>Смотреть примеры работ <span class="arrow"></span></span>
                        </a>
                    @endif
                </div>

                @foreach($services->splice(1)->chunk(2) as $chunk)
                    <div class="services__wrap">
                        @foreach($chunk as $service)
                            <div class="services__item">
                                <h3 class="service__title">
                                    <a href="/services-item/{{ $service->slug }}" >{!! last_word_with_arrow($service->name) !!}</a>
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
