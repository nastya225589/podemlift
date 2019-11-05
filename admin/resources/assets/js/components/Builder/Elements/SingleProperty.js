import React, { Component } from 'react'
import Select from 'react-select'
import Input from './Input'
import DeleteButton from './DeleteButton'

export default class SinglePropery extends Component {
  constructor (props) {
    super(props);
  }

  onInputChange = (index, name, value) => {
    this.props.onInputChangeHandler(this.props.index, value);
  }

  onInputFromChange = (index, name, value) => {
    this.props.onInputFromChangeHandler(this.props.index, value);
  }

  onInputToChange = (index, name, value) => {
    this.props.onInputToChangeHandler(this.props.index, value);
  }

  onSelect = (value, actionMeta) => {
    this.props.onSelectHandler(this.props.index, value);
  }

  deleteButtonHandler = () => {
    this.props.deleteButtonHandler(this.props.index);
  }

  render () {
    return (
      <div className="two-cols">
        <div className="col">
          <Select 
            options={this.props.options}
            placeholder="Выберите параметр"
            value={this.props.selectValue ? this.props.selectValue : ''}
            onChange={this.onSelect}
          />
        </div>
        <div className="col">
          {
            this.props.selectValue.type === 'range' ?
            <div className="two-cols">
              <div className="col">
              От:
              <Input
                name={`${this.props.name}from`}
                type='number'
                value={this.props.inputValue.split('-')[0]}
                onChange={this.onInputFromChange}
              />
              </div>
              -
              <div className="col">
              До:
              <Input
                name={`${this.props.name}to`}
                type='number'
                value={this.props.inputValue.split('-')[1]}
                onChange={this.onInputToChange}
              />
              </div>
            </div>
            :
            <Input
              name={this.props.name}
              type={this.props.selectValue.type}
              value={this.props.inputValue}
              onChange={this.onInputChange}
            />
          }
        </div>
        <DeleteButton onClick={this.deleteButtonHandler} index={this.props.index} />
      </div>
    );
  }
}
