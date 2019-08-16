import React from 'react';
import ReactDOM from 'react-dom';
import Builder from './Builder';
import Gallery from './Elements/Gallery';

const builder = document.getElementById('builder');
if (builder) {
  const textarea = builder.getElementsByTagName('textarea')[0];
  const props = {
    name: textarea.getAttribute('name'),
    value: textarea.value.trim() || '[]'
  };
  ReactDOM.render(<Builder {...props} />, builder);
}

const galleries = document.getElementsByClassName('gallery');
if (galleries.length) {
  const textarea = galleries[0].getElementsByTagName('textarea')[0];
  const props = {
    name: textarea.getAttribute('name'),
    value: textarea.value.trim() || '[]'
  };
  ReactDOM.render(<Gallery {...props} />, galleries[0]);
}
