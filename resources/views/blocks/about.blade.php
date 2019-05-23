<section class="about">
    <div class="container">
        <h2 class="about__title">О компании</h2>
        <ul class="about__list">
            @foreach($page->collection('about_company') as $item)
                <li class="about__item">
                    <h3 class="about__name" style="background: url({{$item->url}}) no-repeat;">{{ $item->intro }}</h3>
                    <p class="about__desc">{!! $item->text !!}</p>
                </li>
            @endforeach
        </ul>
    </div>
</section>
