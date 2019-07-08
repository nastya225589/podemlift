<section class="promo" style="background-image: url({{ $page->image('main_image')->size(1920)->url }});">
    <div class="container">
        <h2 class="promo__title">{{ $page->main_image_text }}</h2>
    </div>

    @include('blocks.form')

</section>
