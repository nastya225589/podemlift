import React, { Component } from 'react';
import Input from './Input';
import DeleteButton from './DeleteButton';
import AddItemButton from './AddItemButton';
import MoveButton from './MoveButton';

export default class Advantages extends Component {
  constructor (props) {
    super(props);

    this.state = {
      advantages: this.props.value
    };
  }

  advantages = () => {
    return this.state.advantages.map((element, index) => {      
      return (
      <div className="two-cols" key={index}>
        <div className="col">
          <Input
            index={index}
            value={element}
            onChange={this.handleInputChange}
          />
        </div>
        <div className="controls">
          <div className="col">
            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index - 1}
              total={this.state.advantages.length}
            />
            <DeleteButton onClick={this.deleteButtonHandler} index={index} />
            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index + 1}
              total={this.state.advantages.length}
            />
          </div>
        </div>
      </div>);
    });
  }

  addItem = () => {
    const advantages = [
      ...this.state.advantages, ''
    ];

    this.setState({ 
      ...this.state,
      advantages
    });
  }

  deleteButtonHandler = (index) => {
    const advantages = this.state.advantages;
    advantages.splice(index, 1); 
    this.setState({ advantages });
  }

  handleInputChange = (index, name, value) => {
    const advantages = [...this.state.advantages];
    advantages[index] = value;
    this.setState(() => ({ advantages: advantages }));
  }

  moveHandler = (currentIndex, newIndex) => {
    this.setState(currentState => {
      const advantages = currentState.advantages;
      const advantage = advantages.splice(currentIndex, 1)[0];
      advantages.splice(newIndex, 0, advantage);

      return { advantages: advantages };
    });
  }

  render () {
    return (
      <div className="item">
        <div className="content">
          {this.advantages()}
          <AddItemButton onClick={this.addItem} />
          <input name={this.props.name} type="hidden" value={JSON.stringify(this.state.advantages)}></input>
        </div>
      </div>
    );
  }
}
