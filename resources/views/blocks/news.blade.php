<section class="news">
    <ul class="new__list">
        @foreach ($news as $item)
            @include('blocks.new')    
        @endforeach
    </ul>
</section>
