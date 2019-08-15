<div class="features__wrapper">
    <div class="features__decs">
        @if(is_array($content))
            @foreach($content as $item)
                {!! $item !!}
            @endforeach
        @endif
    </div>
</div>
