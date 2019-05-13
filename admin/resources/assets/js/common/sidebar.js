require('jquery');

$(function () {
    let controller = _.take(location.pathname.split('/'), 3).join('/');
    $(`.sidebar [href*="${controller}"]`).addClass('active');
});