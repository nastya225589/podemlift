import React, { Component } from 'react';

export default class Input extends Component {
  constructor (props) {
    super(props);
    this.onChange = this.onChange.bind(this);
  }

  onChange (e) {
    this.props.onChange(this.props.index, this.props.name, e.target.value);
  }

  render () {
    return (
      <input
        type="text"
        className="form-control"
        onChange={this.onChange}
        value={this.props.value}
      ></input>
    );
  }
}
