<section class="form-poll">
    <fieldset class="form-poll__fieldset">
        <legend class="form-poll__legend">Контактная информация</legend>
        <div class="checkout__user">
            <label class="field-text">
                <span class="field-text__name">Имя*</span>
                <span class="field-text__input-wrap">
                      <input class="field-text__input" type="text" name="firstname" id="firstname"  placeholder="Иван"/>
                      <span class="form__error"></span>
                    </span>
            </label>
            <label class="field-text">
                <span class="field-text__name">Организация*</span>
                <span class="field-text__input-wrap">
                      <input class="field-text__input" type="text" name="lastname" id="lastname"  placeholder="Помидоров"/>
                      <span class="form__error"></span>
                    </span>
            </label>
            <label class="field-text">
                <span class="field-text__name">Номер телефона*</span>
                <span class="field-text__input-wrap">
                      <input class="field-text__input" type="tel" name="phone" id="phone"  placeholder="+7 812 000 00 00"/>
                      <span class="form__error"></span>
                    </span>
            </label>
            <label class="field-text">
                <span class="field-text__name">Адрес электронной почты</span>
                <span class="field-text__input-wrap">
                      <input class="field-text__input" type="email" name="email"  id="email"  placeholder="user@mail.com"/>
                      <span class="form__error"></span>
                    </span>
            </label>
            <label class="field-text">
                <span class="field-text__name">Почтовый адрес</span>
                <span class="field-text__input-wrap">
                      <input class="field-text__input" type="email" name="email"  id="email"/>
                      <span class="form__error"></span>
                    </span>
            </label>
        </div>
    </fieldset>
    <fieldset class="form-poll__fieldset">
        <legend class="form-poll__legend">Характеристики подъемника</legend>
        <div class="checkout__user">
            <label class="field-text">
                <span class="field-text__name">Желаемая или максимальная дата поставки/монтажа</span>
                <span class="field-text__input-wrap">
                      <input class="field-text__input" type="text" name="firstname" id="firstname"/>
                      <span class="form__error"></span>
                    </span>
            </label>
            <div class="field-select">
                <div class="field-select__name">Доставка и монтаж</div>
                <div class="field-select__select-wrap">
                    <select class="field-select__select" name="pickup-points">
                        <option selected="selected" disabled>Выбрать</option>
                        <option value="1">Малая каштановая аллея, 9 , м. Площадь Александра Невского-2 </option>
                        <option value="2">ул. конунга Ульянова, 18/49, м. Петроградская</option>
                        <option value="3">Кронверкский проспект, 23, м. Горьковская</option>
                    </select>
                </div>
            </div>
            <label class="field-text">
                <span class="field-text__name">Грузоподъемность, кг</span>
                <span class="field-text__input-wrap">
                      <input class="field-text__input" type="text" name="phone" id="phone"/>
                      <span class="form__error"></span>
                    </span>
            </label>
            <label class="field-text">
                <span class="field-text__name">Высота подъема</span>
                <span class="field-text__input-wrap">
                      <input class="field-text__input" type="text" name="email"  id="email"/>
                      <span class="field-text__desc">Расстояние между нижним и верхним уровнями погрузки/выгрузки</span>
                      <span class="form__error"></span>
                    </span>
            </label>
            <div class="field-select">
                <div class="field-select__name">Тип подъемника</div>
                <div class="field-select__select-wrap">
                    <select class="field-select__select" name="pickup-points">
                        <option selected="selected" disabled>Выбрать</option>
                        <option value="1">Малая каштановая аллея, 9 , м. Площадь Александра Невского-2 </option>
                        <option value="2">ул. конунга Ульянова, 18/49, м. Петроградская</option>
                        <option value="3">Кронверкский проспект, 23, м. Горьковская</option>
                    </select>
                </div>
            </div>
            <div class="field-select">
                <div class="field-select__name">Место установки</div>
                <div class="field-select__select-wrap">
                    <select class="field-select__select" name="pickup-points">
                        <option selected="selected" disabled>Выбрать</option>
                        <option value="1">Малая каштановая аллея, 9 , м. Площадь Александра Невского-2 </option>
                        <option value="2">ул. конунга Ульянова, 18/49, м. Петроградская</option>
                        <option value="3">Кронверкский проспект, 23, м. Горьковская</option>
                    </select>
                </div>
            </div>
            <div class="field-select">
                <div class="field-select__name">Количество фиксированных остановок</div>
                <div class="field-select__select-wrap">
                    <select class="field-select__select" name="pickup-points">
                        <option selected="selected" disabled>Выбрать</option>
                        <option value="1">Малая каштановая аллея, 9 , м. Площадь Александра Невского-2 </option>
                        <option value="2">ул. конунга Ульянова, 18/49, м. Петроградская</option>
                        <option value="3">Кронверкский проспект, 23, м. Горьковская</option>
                    </select>
                </div>
            </div>

            <div class="field-checkbox">
                <div class="field-checkbox__name">Способ загрузки платформы</div>
                <div class="field-checkbox__checkbox-wrap">
                    <div class="field-checkbox__checkbox" id="scope-checkbox">
                        <p>
                            <input value="krsanyy" name="tsvet[]" type="checkbox" id="tsvetkrsanyy" class="field-checkbox__input" style="display:none">
                            <label for="tsvetkrsanyy" class="field-checkbox__check">
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
                            <input value="siniy" name="tsvet[]" type="checkbox" id="tsvetsiniy" class="field-checkbox__input" style="display:none">
                            <label for="tsvetsiniy" class="field-checkbox__check">
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
                            <input value="color" name="tsvet[]" type="checkbox" id="tsvetcolor" class="field-checkbox__input" style="display:none">
                            <label for="tsvetcolor" class="field-checkbox__check">
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
            </div>

            <div class="field-select">
                <div class="field-select__name">Тип платформы</div>
                <div class="field-select__select-wrap">
                    <select class="field-select__select" name="pickup-points">
                        <option selected="selected" disabled>Выбрать</option>
                        <option value="1">Малая каштановая аллея, 9 , м. Площадь Александра Невского-2 </option>
                        <option value="2">ул. конунга Ульянова, 18/49, м. Петроградская</option>
                        <option value="3">Кронверкский проспект, 23, м. Горьковская</option>
                    </select>
                </div>
            </div>
            <div class="field-radio">
                <div class="field-radio__title">Откидные борты на платформе со сторон загрузки/выгрузки</div>
                <div class="field-radio__input-wrap">
                    <label class="field-radio__name">
                        <input class="field-radio__input" type="radio" name="sides" checked="checked" value="1"/>
                        <span class="field-radio__name-text">Да</span>
                    </label>
                    <label class="field-radio__name">
                        <input class="field-radio__input" type="radio" name="sides" value="2"/>
                        <span class="field-radio__name-text">Нет</span>
                    </label>
                </div>
            </div>
            <div class="field-radio">
                <div class="field-radio__title">Распашные двери платформы подъемника со сторон загрузки</div>
                <div class="field-radio__input-wrap">
                    <label class="field-radio__name">
                        <input class="field-radio__input" type="radio" name="door" checked="checked" value="1"/>
                        <span class="field-radio__name-text">Да</span>
                    </label>
                    <label class="field-radio__name">
                        <input class="field-radio__input" type="radio" name="door" value="2"/>
                        <span class="field-radio__name-text">Нет</span>
                    </label>
                </div>
            </div>
            <div class="field-radio">
                <div class="field-radio__title">Системы сигнализации</div>
                <div class="field-radio__input-wrap">
                    <label class="field-radio__name">
                        <input class="field-radio__input" type="radio" name="alarm" checked="checked" value="1"/>
                        <span class="field-radio__name-text">Да</span>
                    </label>

                    <label class="field-radio__name">
                        <input class="field-radio__input" type="radio" name="alarm" value="2"/>
                        <span class="field-radio__name-text">Нет</span>
                    </label>
                </div>
            </div>

        </div>
    </fieldset>
    <fieldset class="form-poll__fieldset">
        <legend class="form-poll__legend">Дополнительно</legend>
        <div class="checkout__user">
            <label class="field-text cart__delivery-comment">
                <span class="field-text__name">Примечания</span>
                <span class="field-text__input-wrap">
                  <textarea class="field-text__input field-text__input-comment" name="delivery-address-comment" placeholder="Укажите подробности заказа"></textarea>
                </span>
            </label>
        </div>
        <div class="field-actions">
            <button class="btn  form-poll__btn">Оплатить</button>
            <p class="checkout__conditions">Нажимая кнопку «Отправить» вы соглашаетесь с установленной <a href="#">Политикой конфиденциальности</a></p>
        </div>
    </fieldset>
</section>
