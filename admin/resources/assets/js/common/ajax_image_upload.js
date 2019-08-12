$(document)
  .on('change', '.upload-image-file', function (event) {
    event.preventDefault();

    var $image = $(this);
    var $id = $image.closest('.form-group').find('.upload-image-id');
    var $name = $image.closest('.form-group').find('.upload-image-name');
    var $preview = $image.closest('.form-group').find('.upload-image-preview');
    var formData = new FormData();

    formData.append('image', $image.prop('files')[0]);
    formData.append('_token', $('meta[name="csrf-token"]').attr('content'));

    $.ajax({
      url: '/admin/image/upload',
      type: 'post',
      data: formData,
      async: false,
      cache: false,
      contentType: false,
      enctype: 'multipart/form-data',
      processData: false,
      dataType: 'json',
      success: function (resp) {
        console.log(resp);
        $id.val(resp.id);
        $name.val(resp.alt);
        $preview.html(`<img src="${resp.url}">`);
      },
      error: function (resp) {
        console.log(resp);
      }
    });
  })
  .on('click', '.upload-image-button', function () {
    $(this).closest('.form-group').find('.upload-image-file').click();
  });
