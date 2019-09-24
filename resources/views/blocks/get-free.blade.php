@php ($iconsInline = $page->collection('iconsInline'))

@if (isset($iconsInline['imgUrl']))
    <section style="background-image: url('{{$iconsInline['imgUrl']}}')" class="get-free">    
@else
    <section class="get-free">
@endif

    <div class="container">
        <h2 class="title-h2 get-free__title">При обращении вы получаете бесплатно:</h2>
        <div class="get-free__list">
            @isset($iconsInline['iconsInline'])
                @foreach ($iconsInline['iconsInline'] as $item)
                    <div class="get-free__item">
                        <div class="get-free__photo">
                            <img src="{{ $item->imgUrl }}" alt="" class="get-free__img">
                        </div>
                        <span class="get-free__name">{{ $item->title }}</span>
                    </div> 
                @endforeach
            @endisset
        </div>
    </div>
</section>
