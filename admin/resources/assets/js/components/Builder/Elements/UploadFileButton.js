import React, { Component } from 'react';

export default class UploadFileButton extends Component {
  constructor (props) {
    super(props);
  }

  onChange = (e) => {
    const formData = new FormData();
    formData.append('file', e.target.files[0]);
    axios.post('/admin/file/upload', formData).then(response => {
      this.props.onClick(this.props.index, response.data.path);
    });
  }

  render () {
    return (
      <div className="upload">
        <i className="fas fa-cloud-upload-alt" onClick={e => e.target.nextSibling.click() }></i>
        <input style={{ display: 'none' }} type="file" onChange={this.onChange} />
      </div>
    );
  }
}
