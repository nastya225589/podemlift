import React, { Component } from 'react';
import { Editor } from '@tinymce/tinymce-react';

export default class TinyMce extends Component {
    constructor(props) {
        super(props);
        this.handleEditorChange = this.handleEditorChange.bind(this);
    }

    handleEditorChange(e) {
        this.props.onChange(this.props.index, this.props.name, e.target.getContent());
    }

    render() {
        return (
            <Editor
                initialValue={this.props.value}
                init={{
                    plugins: 'link image code',
                    toolbar: 'undo redo | bold italic | alignleft aligncenter alignright | code'
                }}
                onChange={this.handleEditorChange}
            />
        );
    }
}