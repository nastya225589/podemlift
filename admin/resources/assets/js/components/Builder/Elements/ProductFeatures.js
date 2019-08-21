import React, { Component } from 'react';

export default class ProductFeatures extends Component {
  constructor (props) {
    super(props);
  }

  render () {
    return (
      <div className="features" index={this.props.index}>
        <span>Блок преимуществ</span>
      </div>
    );
  }
}
