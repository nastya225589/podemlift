<section class="storys">
    <ul class="story__list">
        @foreach ($stories as $item)
            @include('blocks.story')    
        @endforeach
    </ul>
</section>
