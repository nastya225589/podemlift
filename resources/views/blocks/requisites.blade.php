@php ($requisites = $page->collection('requisites'))
<section class="requisites">
    <h2 class="title-h2 requisites__title">Реквизиты компании</h2>
    <ul class="requisites__list">
        @foreach ($requisites as $item)
            <li class="requisites__item">
                <span>{{ $item->title }}:</span> {{ $item->value }}
            </li>
        @endforeach
    </ul>
</section>






