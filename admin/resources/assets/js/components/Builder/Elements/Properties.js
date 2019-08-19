import React, { Component } from 'react'
import SingleProperty from './SingleProperty'
import AddItemButton from './AddItemButton'

export default class Properties extends Component {
  constructor (props) {
    super(props);

    this.state = {
      properties: [
        {
          property: {},
          value: ''
        }
      ],
      options: this.props.options
    };
  }

  properties = () => {    
    return this.state.properties.map((element, index) => {      
      return <SingleProperty
        key={index}
        index={index}
        options={this.state.options}
        inputValue={element.value}
        selectValue={element.property}
        deleteButtonHandler={this.deleteButtonHandler}
        onInputChangeHandler={this.handleInputChange}
        onSelectHandler={this.handleSelectChange}
      />
    });
  }

  addProperty = () => {
    this.state.properties.push(
        {
          property: {},
          value: ''
        }
    );    
    this.setState({ properties: this.state.properties });
  }

  deleteButtonHandler = (index) => {
    this.setState(currentState => {
      const properties = currentState.properties;
      const options = this.addOption(this.state.options, properties[index].property);
      properties.splice(index, 1); 
      return { 
        properties: properties,
        options: options
      };
    });
  }

  handleInputChange = (index, value) => {
    this.state.properties[index].value = value;
    this.setState(() => ({ properties: this.state.properties }));
  }

  handleSelectChange = (index, value) => {
    const oldValue = this.state.properties[index].property;
    let options = this.removeOption(value);
    if (oldValue.value) {
      options = this.addOption(options, oldValue);
    }
    this.state.properties[index].property = value;

    this.setState(() => ({ 
      properties: this.state.properties,
      options: options
    }));
  }

  removeOption = (option) => {
    let options = this.state.options;    
    if (options.length) {
      options = options.filter(function( obj ) {
        return obj.value !== option.value;
      });
    }
    return options;
  }

  addOption = (array, option) => {
    if (option.value)
      array.push(option);
    return array;
  }

  render () {    
    return (
      <div className="item">
        <div className="content">
          <div className="two-cols">
            <div className="col">
              <span>Название</span>
            </div>
            <div className="col">
              <span>Значение</span>
            </div>
          </div>
          {this.properties()}
          <AddItemButton onClick={this.addProperty} />
          <input name={this.props.name} type="hidden" value={JSON.stringify(this.state.properties)}></input>
        </div>
      </div>
    );
  }
}
