import React, { Component } from 'react'
import Input from './Input'
import DeleteButton from './DeleteButton'
import AddItemButton from './AddItemButton'
import UploadButton from './UploadButton'

export default class iconsInlineInline extends Component {
  constructor (props) {
    super(props);

    this.state = {
      imgUrl: this.props.value.imgUrl  || '',
      iconsInline: this.props.value.iconsInline || []
    };
  }

  iconsInline = () => {
    return this.state.iconsInline.map((element, index) => {      
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
    const iconsInline = [
      ...this.state.iconsInline, {
          title: '',
          imgUrl: ''
      }
    ];

    this.setState({ 
      ...this.state,
      iconsInline
    });
  }

  deleteButtonHandler = (index) => {
    const iconsInline = this.state.iconsInline;
    iconsInline.splice(index, 1); 
    this.setState({ iconsInline });
  }

  uploadHandler = (index, url) => {
    this.state.iconsInline[index].imgUrl = url;
    this.setState(() => ({ iconsInline: this.state.iconsInline }));
  }

  uploadBackgroundHandler = (index, url) => {
    this.state.imgUrl = url;
    this.setState(() => ({ imgUrl: this.state.imgUrl }));
  }

  handleInputChange = (index, name, value) => {
    this.state.iconsInline[index].title = value;
    this.setState(() => ({ iconsInline: this.state.iconsInline }));
  }

  render () {
    return (
      <div className="item">
        <div className="content">
          <div className="images cols-5">
              <div className="images-image">
                  <img src={this.state.imgUrl} />
              </div>
              <div className="images-image">
                  <UploadButton 
                      onClick={this.uploadBackgroundHandler}
                  />
              </div>
          </div>
          {this.iconsInline()}
          <AddItemButton onClick={this.addItem} />
          <input name={this.props.name} type="hidden" value={JSON.stringify(this.state)}></input>
        </div>
      </div>
    );
  }
}
