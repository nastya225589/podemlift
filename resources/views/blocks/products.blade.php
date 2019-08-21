<section class="products">
    <div class="container">
        <div class="products__title title-h2">Продукция</div>
        <div class="products__wrap">
            @foreach(\App\Models\Product::limit(4)->get() as $item)
                @include('blocks.card-grid')
            @endforeach
        </div>
    </div>
</section>
