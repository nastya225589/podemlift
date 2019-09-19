<div class="breadcrumbs">
    <ul class="breadcrumbs__list">
        <li class="breadcrumbs__link">
            <a href="/">Главная</a>&nbsp;
        </li>
        
        @php($catalog = \App\Models\Page::where('behavior', 'catalog')->first())
        <li class="breadcrumbs__link">
            <a href="{{ $catalog->url }}">{{ $catalog->name }}</a>&nbsp;
        </li>
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
