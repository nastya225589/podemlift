import React, { Component } from 'react'
import Input from './Input'
import DeleteButton from './DeleteButton'
import AddItemButton from './AddItemButton'

export default class Requisites extends Component {
  constructor (props) {
    super(props);

    this.state = {
      requisites: this.props.value
    };
  }

  requisites = () => {
    return this.state.requisites.map((element, index) => {      
      return (
      <div className="two-cols" key={index}>
        <div className="col">
          <label>Наименование</label>
          <Input
            index={index}
            value={element.title}
            onChange={this.handleTitleChange}
          />
        </div>
        <div className="col">
          <label>Значение</label>
          <Input
            index={index}
            value={element.value}
            onChange={this.handleValueChange}
          />
        </div>
        <DeleteButton onClick={this.deleteButtonHandler} index={index} />
      </div>);
    });
  }

  addItem = () => {
    const requisites = [
      ...this.state.requisites, {
        title: '',
        value: '',
      }
    ];

    this.setState({ 
      ...this.state,
      requisites
    });
  }

  deleteButtonHandler = (index) => {
    const requisites = this.state.requisites;
    requisites.splice(index, 1); 
    this.setState({ requisites });
  }

  handleTitleChange = (index, name, value) => {
    this.state.requisites[index].title = value;
    this.setState(() => ({ requisites: this.state.requisites }));
  }

  handleValueChange = (index, name, value) => {
    this.state.requisites[index].value = value;
    this.setState(() => ({ requisites: this.state.requisites }));
  }

  render () {
    return (
      <div className="item">
        <div className="content">
          {this.requisites()}
          <AddItemButton onClick={this.addItem} />
          <input name={this.props.name} type="hidden" value={JSON.stringify(this.state.requisites)}></input>
        </div>
      </div>
    );
  }
}
