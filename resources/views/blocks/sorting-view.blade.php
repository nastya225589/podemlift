<div class="sorting-view">
    <div class="sorting-view__wrap">
        <span class="sorting-view__name">Выводить по</span>
        <button class="sorting-view__btn sorting-view__btn--active">12</button>
        <button class="sorting-view__btn">24</button>
        <button class="sorting-view__btn">36</button>
    </div>

    <div class="sorting-view__wrap">
        <span class="sorting-view__name">Отображать в виде</span>
        @if (Cookie::get('shorting_view_type') == 'line')
            <button class="sorting-view__btn sorting-view__btn--line sorting-view__btn-view--active">
                <span></span>
            </button>
            <button class="sorting-view__btn sorting-view__btn--grid">
                <span></span>
            </button>
        @else
            <button class="sorting-view__btn sorting-view__btn--line">
                <span></span>
            </button>
            <button class="sorting-view__btn sorting-view__btn--grid sorting-view__btn-view--active">
                <span></span>
            </button>
        @endif
    </div>
</div>
