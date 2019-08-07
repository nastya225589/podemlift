<section class="products">
    <div class="container">
        <div class="products__title title-h2">Продукция</div>
        <div class="products__wrap">
            @foreach(\App\Models\Product::limit(4)->get() as $product)
                @include('blocks.card')
            @endforeach
        </div>
    </div>
</section>
