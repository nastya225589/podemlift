import React, { Component } from 'react';
import Input from './Input';

export default class Header extends Component {
  constructor (props) {
    super(props);

    this.state = {
      element: this.props.content
    };
  }

  updateParentState () {
    this.props.onChange(this.props.index, this.state.element);
  }

  handleInputChange = (index, name, value) => {
    let element = this.state.element;
    element = value;
    this.setState(() => ({ element: element }), () => this.updateParentState());    
  }

  render () {
    return (
      <Input
        name={this.props.name}
        index={this.props.index}
        value={this.props.content || ''}
        onChange={this.handleInputChange}
      />
    );
  }
}
