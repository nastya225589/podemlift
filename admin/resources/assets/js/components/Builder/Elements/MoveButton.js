import React, { Component } from 'react';

export default class MoveButton extends Component {
  constructor (props) {
    super(props);

    this.onClick = this.onClick.bind(this);
  }

  onClick () {
    this.props.onClick(this.props.currentIndex, this.props.newIndex);
  }

  icon () {
    const count = this.props.total;
    const moveUp = this.props.currentIndex > this.props.newIndex;
    const isFirstElement = this.props.currentIndex === 0;
    const isLastElement = this.props.currentIndex === count - 1;

    if (isFirstElement && moveUp || isLastElement && !moveUp) { return ''; }

    return (
      <i
        className={`fas fa-arrow-${moveUp ? 'up' : 'down'}`}
        onClick={this.onClick}
      ></i>
    );
  }

  render () {
    return (
      <div className="move">
        {this.icon()}
      </div>
    );
  }
}
