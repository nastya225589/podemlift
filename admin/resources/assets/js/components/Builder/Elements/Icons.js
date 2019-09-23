import React, { Component } from 'react'
import Input from './Input'
import DeleteButton from './DeleteButton'
import AddItemButton from './AddItemButton'
import UploadButton from './UploadButton'

export default class Icons extends Component {
  constructor (props) {
    super(props);

    this.state = {
      icons: this.props.value
    };
  }

  icons = () => {
    return this.state.icons.map((element, index) => {      
      return (
      <div className="two-cols" key={index}>
        <div className="images cols-5">
            <div className="images-image">
                <img src={element.imgUrl} />
            </div>
            <div className="images-image">
                <UploadButton 
                    index={index}
                    onClick={this.uploadHandler}
                />
            </div>
            <Input
                index={index}
                value={element.title || ''}
                onChange={this.handleInputChange}
            />
        </div>
        <DeleteButton onClick={this.deleteButtonHandler} index={index} />
      </div>);
    });
  }

  addItem = () => {
    const icons = [
      ...this.state.icons, {
          title: '',
          imgUrl: ''
      }
    ];

    this.setState({ 
      ...this.state,
      icons
    });
  }

  deleteButtonHandler = (index) => {
    const icons = this.state.icons;
    icons.splice(index, 1); 
    this.setState({ icons });
  }

  uploadHandler = (index, url) => {
    this.state.icons[index].imgUrl = url;
    this.setState(() => ({ icons: this.state.icons }));
  }

  handleInputChange = (index, name, value) => {
    this.state.icons[index].title = value;
    this.setState(() => ({ icons: this.state.icons }));
  }

  render () {
    return (
      <div className="item">
        <div className="content">
          {this.icons()}
          <AddItemButton onClick={this.addItem} />
          <input name={this.props.name} type="hidden" value={JSON.stringify(this.state.icons)}></input>
        </div>
      </div>
    );
  }
}
