import React, { Component } from 'react'
import Input from './Input'
import DeleteButton from './DeleteButton'
import AddItemButton from './AddItemButton'

export default class Redirects extends Component {
  constructor (props) {
    super(props);

    this.state = {
      redirects: this.props.value
    };
  }

  redirects = () => {
    return this.state.redirects.map((element, index) => {      
      return (
      <div className="two-cols" key={index}>
        <div className="col">
          <Input
            index={index}
            value={element}
            onChange={this.handleInputChange}
          />
        </div>
        <DeleteButton onClick={this.deleteButtonHandler} index={index} />
      </div>);
    });
  }

  addRedirect = () => {
    const redirects = [
      ...this.state.redirects, ''
    ];

    this.setState({ 
      ...this.state,
      redirects
    });
  }

  deleteButtonHandler = (index) => {
    const redirects = this.state.redirects;
    redirects.splice(index, 1); 
    this.setState({ redirects });
  }

  handleInputChange = (index, name, value) => {
    this.state.redirects[index] = value;
    this.setState(() => ({ redirects: this.state.redirects }));
  }

  render () {
    return (
      <div className="item">
        <div className="content">
          <div className="col">
            <span>Url</span>
          </div>
          {this.redirects()}
          <AddItemButton onClick={this.addRedirect} />
          <input name={this.props.name} type="hidden" value={JSON.stringify(this.state.redirects)}></input>
        </div>
      </div>
    );
  }
}
