import axios from 'axios';

export default class FormPopup {
  constructor () {
    $(() => {
      $('#form-popup .form-popup__btn').on('click', (e) => {
        e.preventDefault();
        this.send();
      });
    });
  }

  send () {
    $('#form-popup .form-popup__btn').text('Отправка...');
    const data = this.serialize();
    axios.post('/back-call/send', data)
    .then( (response) => {
      $('#form-popup .checkout__user').fadeOut();
      $('#form-popup .field-actions').fadeOut();
      $('#form-popup .form-popup__text-wrap').text(response.data.message)
    })
    .catch( error => {
      $('#form-popup .form-popup__btn').text('Отправить');
      if (error.response.status == 422) {							
				$.each(error.response.data.errors, function (i, error) {
          let el = $('#form-popup').find('[name="' + i + '"]');
          el.addClass('field-text__input-error')
					el.after($('<span class="field-text__error field-text__error-active">' + error[0] + '</span>'));
        });
      }
    });
  }

  serialize () {
    var unindexed_array = $('#form-popup').serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
  }
}
