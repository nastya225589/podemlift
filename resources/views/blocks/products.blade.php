<?php $products = \App\Models\Product::all(); ?>

<section class="products">
<div class="container">
    <div class="products__title title-h2">Продукция</div>
    <div class="products__wrap">
        @foreach($products as $product)
            @include('blocks.card')
        @endforeach
    </div>
</div>
</section>
