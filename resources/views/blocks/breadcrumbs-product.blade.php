<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        @php($parent = $product->categories[0]->parent)

        @prepend('breadcrumbs')
            <li class="breadcrumbs__link">
                @foreach ($product->categories as $category)
                    <a href="{{ $category->url }}">{{ $category->name }}</a>&nbsp;
                @endforeach
            </li>
        @endprepend
        
        @while ($parent)
            @prepend('breadcrumbs')
                <li class="breadcrumbs__link">
                    <a href="{{ $parent->url }}">{{ $parent->name }}</a>
                </li>
            @endprepend
            @php($parent = $parent->parent)
        @endwhile
        
        @stack('breadcrumbs')

        <li class="breadcrumbs__link breadcrumbs__link-active">{{ $product->name }}</li>
    </ul>
</div>
