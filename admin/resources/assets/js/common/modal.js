require('jquery');

$(function () {
  $('[href="#modal-lg"]').click(function () {
    $('#modal-lg .modal-content').load($(this).data('from'));
  });
});
