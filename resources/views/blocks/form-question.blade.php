<section class="form-question">
    @if (Session::get('sended'))
        <legend class="form-poll__legend">Спасибо, форма успешно отправлена.</legend>
    @else
        <form method="post" action="/form-question/send">
            @csrf
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
                        <input value="{{ old('firstname') ?? null }}" class="field-text__input" type="text" name="firstname" id="firstname"  placeholder="Иван"/>
                        <span class="form__error"></span>
                        </span>
                        @if ($errors->has('firstname'))
                            <span class="help-block">
                                <strong>{{ $errors->first('firstname') }}</strong>
                            </span>
                        @endif
                    </label>
                    <label class="field-text">
                        <span class="field-text__name">Номер телефона*</span>
                        <span class="field-text__input-wrap">
                        <input value="{{ old('phone') ?? null }}" class="field-text__input" type="tel" name="phone" id="phone"  placeholder="+7 812 000 00 00"/>
                        <span class="form__error"></span>
                        </span>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </label>
                    <label class="field-text">
                        <span class="field-text__name">Компания</span>
                        <span class="field-text__input-wrap">
                        <input value="{{ old('company') ?? null }}" class="field-text__input" type="text" name="company"  id="company"  placeholder="ООО 'HHGH'"/>
                        <span class="form__error"></span>
                        </span>
                        @if ($errors->has('company'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                        @endif
                    </label>
                </div>

                <label class="field-text field-text-textarea">
                    <span class="field-text__name">Текст вопроса</span>
                    <span class="field-text__textarea-wrap">
                    <textarea class="field-text__input field-text__input-textarea" name="question" placeholder="Задайте вопрос специалисту">
                            {{ old('question') ?? null }}
                    </textarea>
                    </span>
                    @if ($errors->has('question'))
                        <span class="help-block">
                            <strong>{{ $errors->first('question') }}</strong>
                        </span>
                    @endif
                </label>

                <div class="field-actions">
                    <p class="field-actions__conditions">Нажимая кнопку «Отправить» вы соглашаетесь с установленной <a href="#">Политикой конфиденциальности</a></p>
                    <button class="btn  form-question__btn">Отправить</button>
                </div>

            </fieldset>
        </form>
    @endif
</section>
