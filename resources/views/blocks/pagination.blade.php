@if ($paginator->hasPages())
    <div class="pagination">
        @if ($paginator->onFirstPage())
            <div class="pagination__btn pagination__btn--arrow-left disabled">Назад</div>
        @else
            <a class="pagination__btn  pagination__btn--arrow-left" href="{{ $paginator->previousPageUrl() }}">Назад</a>
        @endif

        <div class="pagination__list">
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <a class="disabled">{{ $element }}</a>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <a class="pagination__item pagination__item--active" href="{{ $url }}">{{ $page }}</a>
                        @else
                            <a class="pagination__item" href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
        </div>

        @if ($paginator->hasMorePages())
            <a class="pagination__btn  pagination__btn--arrow-right" href="{{ $paginator->nextPageUrl() }}">Вперед</a>
        @else
            <div class="pagination__btn pagination__btn--arrow-right disabled">Вперед</div>
        @endif
    </div>
@endif

