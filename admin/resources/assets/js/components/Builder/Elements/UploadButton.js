import React, { Component } from 'react';

export default class UploadButton extends Component {
    constructor(props) {
        super(props);
        this.onChange = this.onChange.bind(this);
    }

    onChange(e) {
        let formData = new FormData();
        formData.append('image', e.target.files[0]);
        axios.post('/admin/image/upload', formData).then(response => {
            this.props.onClick(this.props.index, response.data.url);
        });
    }

    render() {
        return (
            <div className="upload">
                <i className="fas fa-cloud-upload-alt" onClick={e => e.target.nextSibling.click() }></i>
                <input style={{display: 'none'}} type="file" onChange={this.onChange} />
            </div>
        );
    }
}