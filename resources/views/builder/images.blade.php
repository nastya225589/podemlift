<div class="features__photo">
    @if(is_array($content))
        @foreach($content as $item)
            <img src="{{ $item->url }}" alt="">
        @endforeach
    @endif
</div>
