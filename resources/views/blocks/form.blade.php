
    <form id="form" class="form" method="post" action="/request-form/send">
        @csrf
        <fieldset class="form__fieldset">
            <div class="form__title title-h2">Получить проект подъемника бесплатно</div>
            @if (Session::get('sended'))
                <p class="form__desc">Заявка отправлена, мы перезвоним вам в течение 15 минут</p>
            @else
                <p class="form__desc">Оставьте заявку и мы перезвоним вам в течение 15 минут</p>
            @endif
            <div class="form__user-data">
                <div class="field-text__wrap">
                    <label class="field-text">
                        <span class="field-text__name">Ваше имя</span>
                        <span class="field-text__input-wrap">
                        <input required value="{{ old('firstname') ?? null }}" class="field-text__input" type="text" name="firstname" id="firstname" placeholder="">
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
                        <input required  value="{{ old('phone') ?? null }}" class="field-text__input" type="tel" name="phone" id="phone" placeholder="">
                        </span>
                        @if ($errors->has('phone'))
                            <span class="help-block">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                        @endif
                    </label>
                </div>

                <p class="form__text">Нажимая на кнопку «Отправить заявку» вы соглашаетесь с обработкой персональных данных</p>
                <button class="btn form__btn">Отправить заявку</button>
            </div>
            @php($google_recaptcha_key = config('settings')->google_recaptcha_key)
            @if($google_recaptcha_key)
                <div class="g-recaptcha" data-sitekey="{{$google_recaptcha_key}}"></div>
                @if ($errors->has('g-recaptcha-response'))
                    <span class="alert">
                        <strong>Выполните проверку</strong>
                    </span>
                @endif
            @endif
        </fieldset>
    </form>


