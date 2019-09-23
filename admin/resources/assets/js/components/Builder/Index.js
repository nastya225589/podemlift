import React from 'react';
import ReactDOM from 'react-dom';
import Builder from './Builder';
import Properties from './Elements/Properties';
import Redirects from './Elements/Redirects';
import Requisites from './Elements/Requisites';
import Addresses from './Elements/Addresses';
import Gallery from './Elements/Gallery';

const builder = document.getElementById('builder');
if (builder) {
  const textarea = builder.getElementsByTagName('textarea')[0];
  const props = {
    name: textarea.getAttribute('name'),
    value: textarea.value.trim() || '[]',
    allowed: textarea.getAttribute('allowed')
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

const properties = document.getElementById('properties');
if (properties) {
  const textarea = properties.getElementsByTagName('textarea')[0];
  const props = {
    name: textarea.getAttribute('name'),
    value: JSON.parse(textarea.value.trim()) || [],
    options: JSON.parse(textarea.getAttribute('options')),
  };
  ReactDOM.render(<Properties {...props} />, properties);
}

const redirects = document.getElementById('redirects');
if (redirects) {
  const textarea = redirects.getElementsByTagName('textarea')[0];
  const props = {
    name: textarea.getAttribute('name'),
    value: JSON.parse(textarea.value.trim()) || []
  };
  ReactDOM.render(<Redirects {...props} />, redirects);
}

const requisites = document.getElementById('requisites');
if (requisites) {
  const textarea = requisites.getElementsByTagName('textarea')[0];
  const props = {
    name: textarea.getAttribute('name'),
    value: JSON.parse(textarea.value.trim()) || []
  };
  ReactDOM.render(<Requisites {...props} />, requisites);
}

const addresses = document.getElementById('addresses');
if (addresses) {
  const textarea = addresses.getElementsByTagName('textarea')[0];
  const props = {
    name: textarea.getAttribute('name'),
    value: JSON.parse(textarea.value.trim()) || []
  };
  ReactDOM.render(<Addresses {...props} />, addresses);
}
