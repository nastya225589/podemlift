<form class="filters" id="filters-form">
    <button class="filters__btn-close btn"></button>
    <fieldset>
        <div class="field-weight">
            <div class="field-weight__name">Желаемый вес, кг</div>
            <div class="field-weight__range-wrap">
                <div class="field-weight__range" id="weight-range">
                    <div class="slider-item">
                        <div class="wrap" style="--min: 0;--max: 100;--val: 50;">
                            <input id="days-css" class="slider"  type="range" value="50"/>
                            <output for="days-css">53</output>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class='field-checkbox'>
            <div class="field-checkbox__name">Сфера применения</div>
            <div class="field-checkbox__checkbox-wrap">
                <div class="field-checkbox__checkbox" id="scope-checkbox">
                    <p>
                        <input type="checkbox" id="scope1" class="field-checkbox__input" style="display:none">
                        <label for="scope1" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>Торговые помещения</span>
                        </label>
                    </p>
                    <p>
                        <input type="checkbox" id="scope2" class="field-checkbox__input" style="display:none">
                        <label for="scope2" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>Складские помещения</span>
                        </label>
                    </p>
                    <p>
                        <input type="checkbox" id="scope3" class="field-checkbox__input" style="display:none">
                        <label for="scope3" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>Производственные помещения</span>
                        </label>
                    </p>
                    <p>
                        <input type="checkbox" id="scope4" class="field-checkbox__input" style="display:none">
                        <label for="scope4" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>Стройка</span>
                        </label>
                    </p>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class='field-checkbox'>
            <div class="field-checkbox__name">Тип крана</div>
            <div class="field-checkbox__checkbox-wrap">
                <div class="field-checkbox__checkbox" id="type-checkbox">
                    <p>
                        <input type="checkbox" id="type1" class="field-checkbox__input" style="display:none">
                        <label for="type1" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>Одномачтовый</span>
                        </label>
                    </p>
                    <p>
                        <input type="checkbox" id="type2" class="field-checkbox__input" style="display:none">
                        <label for="type2" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>Двухмачтовый</span>
                        </label>
                    </p>
                    <p>
                        <input type="checkbox" id="type3" class="field-checkbox__input" style="display:none">
                        <label for="type3" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>Трехмачтовый</span>
                        </label>
                    </p>
                    <p>
                        <input type="checkbox" id="type4" class="field-checkbox__input" style="display:none">
                        <label for="type4" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>Стоейчный</span>
                        </label>
                    </p>
                    <p>
                        <input type="checkbox" id="type5" class="field-checkbox__input" style="display:none">
                        <label for="type5" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>Шахтный</span>
                        </label>
                    </p>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset>
        <div class='field-checkbox'>
            <div class="field-checkbox__name">Грузоподъемность, кг</div>
            <div class="field-checkbox__checkbox-wrap">
                <div class="field-checkbox__checkbox" id="weight-checkbox">
                    <p>
                        <input type="checkbox" id="weight1" class="field-checkbox__input" style="display:none">
                        <label for="weight1" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>250</span>
                        </label>
                    </p>
                    <p>
                        <input type="checkbox" id="weight2" class="field-checkbox__input" style="display:none">
                        <label for="weight2" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>500</span>
                        </label>
                    </p>
                    <p>
                        <input type="checkbox" id="weight3" class="field-checkbox__input" style="display:none">
                        <label for="weight3" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>1000</span>
                        </label>
                    </p>
                    <p>
                        <input type="checkbox" id="weight4" class="field-checkbox__input" style="display:none">
                        <label for="weight4" class="field-checkbox__check">
                            <span>
                                <svg width="22px" height="15px">
                                    <use xlink:href="#check">
                                        <symbol id="check" viewBox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                        </symbol>
                                    </use>
                                </svg>
                            </span>
                            <span>2000</span>
                        </label>
                    </p>
                </div>
            </div>
        </div>
    </fieldset>
    <button class="btn filters__btn">Применить</button>
    <div class="filters__btn-clear_wrap">
        <span class="filters__btn-clear--icon"></span>
        <button class="btn filters__btn-clear">Сбросить фильтры</button>
    </div>
</form>
