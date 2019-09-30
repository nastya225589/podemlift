<section class="form-question">
    <fieldset class="form-question__fieldset">
        <legend class="form-question__legend">Задайте вопрос специалисту</legend>

        <div class="form-question__text-wrap">
            <p class="form-question__text">Если у вас есть вопросы, то вы можете задать их по телефону или через контактную форму. </p>
            <p class="form-question__text">Мы обязательно с вами свяжемся в течение 15 минут</p>
        </div>

        <div class="checkout__user">
            <label class="field-text">
                <span class="field-text__name">Имя</span>
                <span class="field-text__input-wrap">
                  <input class="field-text__input" type="text" name="firstname" id="firstname"  placeholder="Иван"/>
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
                <span class="field-text__name">Компания</span>
                <span class="field-text__input-wrap">
                  <input class="field-text__input" type="text" name="namecompany"  id="namecompany"  placeholder="ООО 'HHGH'"/>
                  <span class="form__error"></span>
                </span>
            </label>
        </div>

        <label class="field-text field-text-textarea">
            <span class="field-text__name">Текст вопроса</span>
            <span class="field-text__textarea-wrap">
              <textarea class="field-text__input field-text__input-textarea" name="delivery-address-comment" placeholder="Задайте вопрос специалисту"></textarea>
            </span>
        </label>

        <div class="field-actions">
            <p class="field-actions__conditions">Нажимая кнопку «Отправить» вы соглашаетесь с установленной <a href="#">Политикой конфиденциальности</a></p>
            <button class="btn  form-question__btn">Отправить</button>
        </div>

    </fieldset>
</section>
