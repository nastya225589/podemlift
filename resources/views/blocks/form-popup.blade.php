<form id="form-popup" class="form-popup">
    @csrf
    <a class="form-popup__btn-close" href="#">
        <span></span>
    </a>
    <fieldset class="form-popup__fieldset">
        <legend class="form-popup__legend">обратный звонок</legend>

        <div class="form-popup__text-wrap">
            <p class="form-popup__text">Оставьте заявку и мы перезвоним вам в течение 15 минут </p>
        </div>

        <div class="checkout__user">
            <label class="field-text">
                <span class="field-text__name">Ваше имя</span>
                <span class="field-text__input-wrap">
                  <input class="field-text__input" type="text" name="firstname" id="firstname"  placeholder="Иван"/>
                </span>
            </label>
            <label class="field-text">
                <span class="field-text__name">Номер телефона*</span>
                <span class="field-text__input-wrap">
                    <input class="field-text__input" type="tel" name="phone" id="phone"  placeholder="+7 812 000 00 00"/>
                </span>
            </label>
            <label class="field-text">
                <span class="field-text__name">Адрес электронной почты</span>
                <span class="field-text__input-wrap">
                    <input class="field-text__input" type="email" name="email"  id="email"  placeholder="user@mail.com"/>
                </span>
            </label>
        </div>

        <div class="field-actions">
            <p class="field-actions__conditions">Нажимая на кнопку «Отправить заявку» вы соглашаетесь <a href="#">с обработкой персональных данных</a></p>
            <button class="btn  form-popup__btn">Отправить</button>
        </div>

    </fieldset>
</form>
