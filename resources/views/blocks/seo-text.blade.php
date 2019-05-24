<section class="seo-text">
    <div class="container">
        <div class="seo-text__wrap">
            <div class="seo-text__desc">
                @if($page->content_title)
                    <h2 class="seo-text__title">{{ $page->content_title }}</h2>
                @endif
                <div class="seo-text__text">
                    {!! $page->content !!}
                </div>
            </div>
            @include('blocks.form')
        </div>
    </div>
</section>
