@while ($parent)
    @prepend('breadcrumbs')
        <li class="breadcrumbs__link">
            <a href="{{ $parent->url }}">{{ $parent->name }}</a>
        </li>
    @endprepend
    @php($parent = $parent->parent)
@endwhile

@stack('breadcrumbs')