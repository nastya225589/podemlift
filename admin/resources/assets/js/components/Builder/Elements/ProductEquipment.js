import React, { Component } from 'react';

export default class ProductEquipment extends Component {
  constructor (props) {
    super(props);
  }

  render () {
    return (
      <div className="features" index={this.props.index}>
        <span>Блок оборудования</span>
      </div>
    );
  }
}
