require('tinymce');
require('tinymce/themes/modern');
require('tinymce/plugins/paste');
require('tinymce/plugins/advlist');
require('tinymce/plugins/autolink');
require('tinymce/plugins/lists');
require('tinymce/plugins/link');
require('tinymce/plugins/image');
require('tinymce/plugins/charmap');
require('tinymce/plugins/print');
require('tinymce/plugins/preview');
require('tinymce/plugins/anchor');
require('tinymce/plugins/textcolor');
require('tinymce/plugins/searchreplace');
require('tinymce/plugins/visualblocks');
require('tinymce/plugins/code');
require('tinymce/plugins/fullscreen');
require('tinymce/plugins/insertdatetime');
require('tinymce/plugins/media');
require('tinymce/plugins/table');
require('tinymce/plugins/contextmenu');
require('tinymce/plugins/code');
require('tinymce/plugins/help');
require('tinymce/plugins/wordcount');

function initEditor () {
  tinymce.init({
    selector: '.editor',
    plugins: 'image, link, code, lists, table',
    toolbar: 'link image code numlist bullist table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
    language: 'ru',
    valid_elements: '+*[*]'
    // file_browser_callback : elFinderBrowser,
    // init_instance_callback: function (editor) {
    //     editor.on('blur', function (e) {
    //         editor.save();
    //         multiItemFill($('#' + editor.id).data('target'));
    //
    //         var matches;
    //         if (typeof app != 'undefined' && (matches = /block-(\d+)/ig.exec(editor.id))) {
    //             app.__vue__.$refs.contentBuilder.blocks[matches[1]].text = editor.getContent();
    //         }
    //     });
    // }
  });
}

function stopEditor () {
  tinymce.remove();
}

if (typeof tinymce !== 'undefined') { initEditor(); }
