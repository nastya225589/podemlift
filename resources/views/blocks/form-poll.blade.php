<section class="form-poll">
    @if (Session::get('sended'))
        <legend class="form-poll__legend">Спасибо, форма успешно отправлена.</legend>
    @else
        <form action="/questionnaire/send" method="POST">
            @csrf
            <fieldset class="form-poll__fieldset">
                <legend class="form-poll__legend">Контактная информация</legend>
                <div class="checkout__user">
                    <label class="field-text">
                        <span class="field-text__name">Имя*</span>
                        <span class="field-text__input-wrap">
                            <input value="{{ old('firstname') }}" class="field-text__input" type="text" name="firstname" id="firstname"  placeholder="Иван"/>
                            <span class="form__error"></span>
                        </span>
                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
                    </label>
                    <label class="field-text">
                        <span class="field-text__name">Организация*</span>
                        <span class="field-text__input-wrap">
                            <input value="{{ old('organization') }}" class="field-text__input" type="text" name="organization" id="organization"  placeholder=""/>
                            <span class="form__error"></span>
                        </span>
                        @if ($errors->has('organization'))
                            <span class="help-block">
                                <strong>{{ $errors->first('organization') }}</strong>
                            </span>
                        @endif
                    </label>
                    <label class="field-text">
                        <span class="field-text__name">Номер телефона*</span>
                        <span class="field-text__input-wrap">
                            <input value="{{ old('phone') }}" class="field-text__input" type="tel" name="phone" id="phone"  placeholder="+7 812 000 00 00"/>
                            <span class="form__error"></span>
                        </span>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </label>
                    <label class="field-text">
                        <span class="field-text__name">Адрес электронной почты</span>
                        <span class="field-text__input-wrap">
                            <input value="{{ old('email') }}" class="field-text__input" type="email" name="email"  id="email"  placeholder="user@mail.com"/>
                            <span class="form__error"></span>
                        </span>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </label>
                    <label class="field-text">
                        <span class="field-text__name">Почтовый адрес</span>
                        <span class="field-text__input-wrap">
                            <input value="{{ old('mailing_address') }}" class="field-text__input" type="text" name="mailing_address"  id="mailing_address"/>
                            <span class="form__error"></span>
                        </span>
                        @if ($errors->has('mailing_address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('mailing_address') }}</strong>
                            </span>
                        @endif
                    </label>
                </div>
            </fieldset>
            <fieldset class="form-poll__fieldset">
                <legend class="form-poll__legend">Характеристики подъемника</legend>
                <div class="checkout__user">
                    <label class="field-text">
                        <span class="field-text__name">Желаемая или максимальная дата поставки/монтажа</span>
                        <span class="field-text__input-wrap">
                            <input value="{{ old('delivery_at') }}" class="field-text__input" type="text" name="delivery_at" id="delivery_at"/>
                            <span class="form__error"></span>
                        </span>
                        @if ($errors->has('delivery_at'))
                            <span class="help-block">
                                <strong>{{ $errors->first('delivery_at') }}</strong>
                            </span>
                        @endif
                    </label>
                    <div class="field-select">
                        <div class="field-select__name">Доставка и монтаж</div>
                        <div class="field-select__select-wrap">
                            <select class="field-select__select" name="delivery">
                                <option {{ old('delivery') == '' ? 'selected' : ''}} disabled>Выбрать</option>
                                <option {{ old('delivery') == 'Нет' ? 'selected' : ''}} value="Нет">Нет</option>
                                <option {{ old('delivery') == 'Да' ? 'selected' : ''}} value="Да">Да</option>
                            </select>
                        </div>
                        @if ($errors->has('delivery'))
                            <span class="help-block">
                                <strong>{{ $errors->first('delivery') }}</strong>
                            </span>
                        @endif
                    </div>
                    <label class="field-text">
                        <span class="field-text__name">Грузоподъемность, кг</span>
                        <span class="field-text__input-wrap">
                            <input value="{{ old('carrying') }}" class="field-text__input" type="number" name="carrying" id="carrying"/>
                            <span class="form__error"></span>
                        </span>
                        @if ($errors->has('carrying'))
                            <span class="help-block">
                                <strong>{{ $errors->first('carrying') }}</strong>
                            </span>
                        @endif
                    </label>
                    <label class="field-text">
                        <span class="field-text__name">Высота подъема</span>
                        <span class="field-text__input-wrap">
                            <input value="{{ old('lift') }}" class="field-text__input" type="number" name="lift"  id="lift"/>
                            <span class="field-text__desc">Расстояние между нижним и верхним уровнями погрузки/выгрузки</span>
                            <span class="form__error"></span>
                        </span>
                        @if ($errors->has('lift'))
                            <span class="help-block">
                                <strong>{{ $errors->first('lift') }}</strong>
                            </span>
                        @endif
                    </label>
                    <div class="field-select">
                        <div class="field-select__name">Тип подъемника</div>
                        <div class="field-select__select-wrap">
                            <select class="field-select__select" name="type_of_lift">
                                <option {{ old('type_of_lift') == '' ? 'selected' : ''}} disabled>Выбрать</option>
                                <option {{ old('type_of_lift') == 'По рекомендации специалиста' ? 'selected' : ''}} value="По рекомендации специалиста">По рекомендации специалиста</option>
                                <option {{ old('type_of_lift') == 'Одномачтовый' ? 'selected' : ''}} value="Одномачтовый">Одномачтовый</option>
                                <option {{ old('type_of_lift') == 'Двухмачтовый' ? 'selected' : ''}} value="Двухмачтовый">Двухмачтовый</option>
                                <option {{ old('type_of_lift') == 'Шахтный' ? 'selected' : ''}} value="Шахтный">Шахтный</option>
                                <option {{ old('type_of_lift') == 'Малый грузовой' ? 'selected' : ''}} value="Малый грузовой">Малый грузовой</option>
                                <option {{ old('type_of_lift') == 'Гидравлический ножничный' ? 'selected' : ''}} value="Гидравлический ножничный">Гидравлический ножничный</option>
                            </select>
                        </div>
                        @if ($errors->has('type_of_lift'))
                            <span class="help-block">
                                <strong>{{ $errors->first('type_of_lift') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="field-select">
                        <div class="field-select__name">Место установки</div>
                        <div class="field-select__select-wrap">
                            <select class="field-select__select" name="place">
                                <option {{ old('place') == '' ? 'selected' : ''}} disabled>Выбрать</option>
                                <option {{ old('place') == 'Не определено' ? 'selected' : ''}} value="Не определено">Не определено</option>
                                <option {{ old('place') == 'Внутри здания в шахту' ? 'selected' : ''}} value="Внутри здания в шахту">Внутри здания в шахту</option>
                                <option {{ old('place') == 'Внутри здания в межэтажный проем/проемы' ? 'selected' : ''}} value="Внутри здания в межэтажный проем/проемы">Внутри здания в межэтажный проем/проемы</option>
                                <option {{ old('place') == 'Снаружи здания, к стене' ? 'selected' : ''}} value="Снаружи здания, к стене">Снаружи здания, к стене</option>
                            </select>
                        </div>
                        @if ($errors->has('place'))
                            <span class="help-block">
                                <strong>{{ $errors->first('place') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="field-select">
                        <div class="field-select__name">Количество фиксированных остановок</div>
                        <div class="field-select__select-wrap">
                            <select class="field-select__select" name="number_of_stops">
                                <option {{ old('number_of_stops') == '' ? 'selected' : ''}} disabled>Выбрать</option>
                                <option {{ old('number_of_stops') == '2' ? 'selected' : ''}} value="2">2</option>
                                <option {{ old('number_of_stops') == '3' ? 'selected' : ''}} value="3">3</option>
                                <option {{ old('number_of_stops') == '4' ? 'selected' : ''}} value="4">4</option>
                                <option {{ old('number_of_stops') == '5' ? 'selected' : ''}} value="5">5</option>
                                <option {{ old('number_of_stops') == '6' ? 'selected' : ''}} value="6">6</option>
                            </select>
                        </div>
                        @if ($errors->has('number_of_stops'))
                            <span class="help-block">
                                <strong>{{ $errors->first('number_of_stops') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="field-checkbox">
                        <div class="field-checkbox__name">Способ загрузки платформы</div>
                        <div class="field-checkbox__checkbox-wrap">
                            <div class="field-checkbox__checkbox" id="scope-checkbox">
                                <p>
                                    <input {{ in_array('Вручную', old('load_method') ?? []) ? 'checked' : '' }} value="Вручную" name="load_method[]" type="checkbox" id="load_method1" class="field-checkbox__input" style="display:none">
                                    <label for="load_method1" class="field-checkbox__check">
                                        <span>
                                            <svg width="22px" height="15px">
                                                <use xlink:href="#check">
                                                    <symbol id="check" viewBox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                                    </symbol>
                                                </use>
                                            </svg>
                                        </span>
                                        <span>Вручную</span>
                                    </label>
                                </p>
                                <p>
                                    <input {{ in_array('На рохле (или других тележках)', old('load_method') ?? []) ? 'checked' : '' }} value="На рохле (или других тележках)" name="load_method[]" type="checkbox" id="load_method2" class="field-checkbox__input" style="display:none">
                                    <label for="load_method2" class="field-checkbox__check">
                                        <span>
                                            <svg width="22px" height="15px">
                                                <use xlink:href="#check">
                                                    <symbol id="check" viewBox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                                    </symbol>
                                                </use>
                                            </svg>
                                        </span>
                                        <span>На рохле (или других тележках)</span>
                                    </label>
                                </p>
                                <p>
                                    <input {{ in_array('С помощью погрузчика', old('load_method') ?? []) ? 'checked' : '' }} value="С помощью погрузчика" name="load_method[]" type="checkbox" id="load_method3" class="field-checkbox__input" style="display:none">
                                    <label for="load_method3" class="field-checkbox__check">
                                        <span>
                                            <svg width="22px" height="15px">
                                                <use xlink:href="#check">
                                                    <symbol id="check" viewBox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 12.5 1"></polyline>
                                                    </symbol>
                                                </use>
                                            </svg>
                                        </span>
                                        <span>С помощью погрузчика</span>
                                    </label>
                                </p>
                            </div>

                            <span class="field-checkbox__desc">Укажите один или несколько вариантов</span>
                        </div>
                        @if ($errors->has('load_method'))
                            <span class="help-block">
                                <strong>{{ $errors->first('load_method') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="field-select">
                        <div class="field-select__name">Тип платформы</div>
                        <div class="field-select__select-wrap">
                            <select class="field-select__select" name="type_of_platform">
                                <option selected="selected" disabled>Выбрать</option>
                                <option value="1">Площадка</option>
                                <option value="2">Клеть (кабина)</option>
                            </select>
                        </div>
                        @if ($errors->has('type_of_platform'))
                            <span class="help-block">
                                <strong>{{ $errors->first('type_of_platform') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="field-radio">
                        <div class="field-radio__title">Откидные борты на платформе со сторон загрузки/выгрузки</div>
                        <div class="field-radio__input-wrap">
                            <label class="field-radio__name">
                                <input class="field-radio__input" type="radio" name="tailgate" {{ old('tailgate') == '1' ? 'checked' : ''}} value="1"/>
                                <span class="field-radio__name-text">Да</span>
                            </label>
                            <label class="field-radio__name">
                                <input class="field-radio__input" type="radio" name="tailgate" {{ !old('tailgate') ? 'checked' : ''}} value="0"/>
                                <span class="field-radio__name-text">Нет</span>
                            </label>
                        </div>
                        @if ($errors->has('tailgate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('tailgate') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="field-radio">
                        <div class="field-radio__title">Распашные двери платформы подъемника со сторон загрузки</div>
                        <div class="field-radio__input-wrap">
                            <label class="field-radio__name">
                                <input class="field-radio__input" type="radio" name="swing_doors" {{ old('swing_doors') == '1' ? 'checked' : ''}} value="1"/>
                                <span class="field-radio__name-text">Да</span>
                            </label>
                            <label class="field-radio__name">
                                <input class="field-radio__input" type="radio" name="swing_doors" {{ !old('swing_doors') ? 'checked' : ''}} value="0"/>
                                <span class="field-radio__name-text">Нет</span>
                            </label>
                        </div>
                        @if ($errors->has('swing_doors'))
                            <span class="help-block">
                                <strong>{{ $errors->first('swing_doors') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="field-radio">
                        <div class="field-radio__title">Системы сигнализации</div>
                        <div class="field-radio__input-wrap">
                            <label class="field-radio__name">
                                <input class="field-radio__input" type="radio" name="signaling" {{ old('signaling') == '1' ? 'checked' : ''}} value="1"/>
                                <span class="field-radio__name-text">Да</span>
                            </label>

                            <label class="field-radio__name">
                                <input class="field-radio__input" type="radio" name="signaling" {{ !old('signaling') ? 'checked' : ''}} value="0"/>
                                <span class="field-radio__name-text">Нет</span>
                            </label>
                        </div>
                    </div>
                    @if ($errors->has('signaling'))
                        <span class="help-block">
                            <strong>{{ $errors->first('signaling') }}</strong>
                        </span>
                    @endif
                </div>
            </fieldset>
            <fieldset class="form-poll__fieldset">
                <legend class="form-poll__legend">Дополнительно</legend>
                <div class="checkout__user">
                    <label class="field-text cart__delivery-comment">
                        <span class="field-text__name">Примечания</span>
                        <span class="field-text__input-wrap">
                        <textarea class="field-text__input field-text__input-comment" name="additionally" placeholder="Укажите подробности заказа">
                            {{old('additionally')}}
                        </textarea>
                        </span>
                        @if ($errors->has('additionally'))
                            <span class="help-block">
                                <strong>{{ $errors->first('additionally') }}</strong>
                            </span>
                        @endif
                    </label>
                </div>
                <div class="field-actions">
                    <button type="submit" class="btn  form-poll__btn">Отправить</button>
                    <p class="checkout__conditions">Нажимая кнопку «Отправить» вы соглашаетесь с установленной <a href="#">Политикой конфиденциальности</a></p>
                </div>
            </fieldset>
        </form>
    @endif
</section>
