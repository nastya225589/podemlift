$(document)
  .on('submit', '.ajax-form', function (event) {
    event.preventDefault();

    var $form = $(this);
    var $success = $form.data('success');
    var $error = $form.data('error');
    var $submitButton = $form.find('[type="submit"]');
    var formData = new FormData($(this)[0]);

    $form.find('.error').html('');
    $submitButton.attr('disabled', true);

    $.ajax({
      url: $form.attr('action'),
      type: 'post',
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false,
      success: function (resp) {
        $submitButton.attr('disabled', false);
        $(document).trigger($success, [$form, resp]);
      },
      error: function (resp) {
        $submitButton.attr('disabled', false);
        $(document).trigger($error, [$form, resp]);
      }
    });
  })
  .on('form:success', function (event, $form, resp) {

  })
  .on('form:error', function (event, $form, resp) {
    $form.find('.error.main-error').html(resp.responseJSON.message);

    $.each(resp.responseJSON.errors, function (name, messages) {
      var nameItems = name.split('.');
      nameItems.forEach(function (value, number) {
        if (number) { nameItems[number] = `[${value}]`; }
      });
      name = nameItems.join('');

      messages.forEach(function (value, number) {
        messages[number] = value.replace(/\.(\d+)\./g, ' ').replace('_', ' ');
      });

      $form.find(`[name="${name}"]`).next('.error').html(messages.join());
    });
  });
