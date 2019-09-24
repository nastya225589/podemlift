import React, { Component } from 'react'
import Input from './Input'
import DeleteButton from './DeleteButton'
import AddItemButton from './AddItemButton'

export default class Addresses extends Component {
  constructor (props) {
    super(props);

    this.state = {
      addresses: this.props.value
    };
  }

  addresses = () => {
    return this.state.addresses.map((element, index) => {      
      return (
      <div className="two-cols" key={index}>
        <div className="col">
          <label>Регион</label>
          <Input
            index={index}
            value={element.region}
            onChange={this.handleRegionChange}
          />
        </div>
        <div className="col">
          <label>Адрес</label>
          <Input
            index={index}
            value={element.address}
            onChange={this.handleAddressChange}
          />
        </div>
        <div className="col">
          <label>Телефон</label>
          <Input
            index={index}
            value={element.phone}
            onChange={this.handlePhoneChange}
          />
        </div>
        <DeleteButton onClick={this.deleteButtonHandler} index={index} />
      </div>);
    });
  }

  addItem = () => {
    const addresses = [
      ...this.state.addresses, {
        region: '',
        address: '',
        phone: '',
      }
    ];

    this.setState({ 
      ...this.state,
      addresses
    });
  }

  deleteButtonHandler = (index) => {
    const addresses = this.state.addresses;
    addresses.splice(index, 1); 
    this.setState({ addresses });
  }

  handleRegionChange = (index, name, value) => {
    this.state.addresses[index].region = value;
    this.setState(() => ({ addresses: this.state.addresses }));
  }

  handleAddressChange = (index, name, value) => {
    this.state.addresses[index].address = value;
    this.setState(() => ({ addresses: this.state.addresses }));
  }

  handlePhoneChange = (index, name, value) => {
    this.state.addresses[index].phone = value;
    this.setState(() => ({ addresses: this.state.addresses }));
  }

  render () {
    return (
      <div className="item">
        <div className="content">
          {this.addresses()}
          <AddItemButton onClick={this.addItem} />
          <input name={this.props.name} type="hidden" value={JSON.stringify(this.state.addresses)}></input>
        </div>
      </div>
    );
  }
}
