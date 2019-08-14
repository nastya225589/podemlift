<div class="sorting-view">
    <div class="sorting-view__wrap">
        <span class="sorting-view__name">Выводить по</span>
        <button class="sorting-view__btn {{ $perPage == 12 ? 'sorting-view__btn--active' : '' }}" data-perpage="12">12</button>
        <button class="sorting-view__btn {{ $perPage == 24 ? 'sorting-view__btn--active' : '' }}" data-perpage="24">24</button>
        <button class="sorting-view__btn {{ $perPage == 36 ? 'sorting-view__btn--active' : '' }}" data-perpage="36">36</button>
    </div>

    <div class="sorting-view__wrap">
        <span class="sorting-view__name">Отображать в виде</span>
        <button class="sorting-view__btn sorting-view__btn--line {{ UserConfig::catalogListingInline() ? 'sorting-view__btn-view--active' : '' }}">
            <span></span>
        </button>
        <button class="sorting-view__btn sorting-view__btn--grid {{ !UserConfig::catalogListingInline() ? 'sorting-view__btn-view--active' : '' }}">
            <span></span>
        </button>
    </div>
</div>
