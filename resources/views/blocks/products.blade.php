<section class="products">
<div class="container">
    <h2 class="products__title">Продукция</h2>
    <div class="products__wrap">
        @foreach($products as $product)
            @include('blocks.card')
        @endforeach
    </div>
</div>
</section>
