import React, { Component } from 'react';
import UploadButton from './UploadButton';
import Input from './Input';

export default class Subtitle extends Component {
  constructor (props) {
    super(props);

    this.state = {
      element: this.props.content || {}
    };
  }

  updateParentState () {
    this.props.onChange(this.props.index, this.props.name, this.state.element);
  }

  handleInputChange = (index, name, value) => {
    let element = this.state.element;
    element.title = value;
    this.setState(() => ({ element: element }), () => this.updateParentState());
  }

  uploadHandler = (index, url) => {
    let element = this.state.element;
    element.imgUrl = url;
    this.setState(() => ({ element: element }), () => this.updateParentState());
  }

  render () {
    return (
      <div className="images cols-5">
        <div className="images-image">
          <img
            src={this.props.content.imgUrl}
          />
        </div>
        <div className="images-image">
          <UploadButton 
            index={this.props.index}
            onClick={this.uploadHandler}
          />
        </div>
        <Input
          name={this.props.name}
          index={this.props.index}
          value={this.props.content.title || ''}
          onChange={this.handleInputChange}
        />
      </div>
    );
  }
}
