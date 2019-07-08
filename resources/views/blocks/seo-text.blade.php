<section class="seo-text">
    <div class="container">
        <div class="seo-text__wrap">
            <div class="seo-text__desc">
                @if($page->content_title)
                    <h1 class="seo-text__title title-h2">{{ $page->content_title }}</h1>
                @endif
                <div class="seo-text__text">
                    {!! $page->content !!}
                </div>
            </div>
            @include('blocks.form')
        </div>
    </div>
</section>
