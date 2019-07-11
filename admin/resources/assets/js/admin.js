window._ = require('lodash');
window.$ = window.jQuery = require('jquery');
window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.headers.common['X-CSRF-TOKEN'] = document.head.querySelector('meta[name="csrf-token"]').content;
// window.Popper = require('popper.js').default;

require('bootstrap');

require('./common/ajax_form');
require('./common/ajax_image_upload');
require('./common/multi_field');
require('./common/tinymce');
require('./common/nestable');
require('./common/sidebar');
require('./common/select');
require('./common/tooltip');
require('./common/modal');

require('./components/Builder');
