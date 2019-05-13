import React from 'react';
import ReactDOM from 'react-dom';
import Builder from './Builder';
import Gallery from './Elements/Gallery';

let builder = document.getElementById('builder');
if (builder) {
    let textarea = builder.getElementsByTagName('textarea')[0];
    let props = {
        name: textarea.getAttribute('name'),
        value: textarea.value || '[]'
    };
    ReactDOM.render(<Builder {...props} />, builder);
}

let galleries = document.getElementsByClassName('gallery');
if (galleries.length) {
    let textarea = galleries[0].getElementsByTagName('textarea')[0];
    let props = {
        name: textarea.getAttribute('name'),
        value: textarea.value || '[]'
    };
    ReactDOM.render(<Gallery {...props} />, galleries[0]);
}
