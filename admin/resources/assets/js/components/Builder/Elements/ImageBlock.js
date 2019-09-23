import React, { Component } from 'react'
import Input from './Input'
import DeleteButton from './DeleteButton'
import AddItemButton from './AddItemButton'
import UploadButton from './UploadButton'
import TinyMce from './TinyMce'

export default class ImageBlock extends Component {
  constructor (props) {
    super(props);

    this.state = {
      imageBlocks: this.props.value
    };
  }

  imageBlocks = () => {
    return this.state.imageBlocks.map((element, index) => {      
      return (
      <div className="two-cols" key={index}>
        <div className="images cols-5">
            <div className="images-image">
                <img src={element.iconUrl} />
            </div>
            <div className="images-image">
                <UploadButton 
                    index={index}
                    onClick={this.uploadIconHandler}
                />
            </div>
            <Input
                index={index}
                value={element.title || ''}
                onChange={this.handleInputChange}
            />
            <TinyMce
                index={index}
                value={element.text || ''}
                onChange={this.handleTextareaChange}
            />
            <label>Показатель (необязательно)</label>
            <Input
                index={index}
                value={element.value || ''}
                onChange={this.handleValueChange}
            />
            <label>Описание (необязательно)</label>
            <Input
                index={index}
                value={element.description || ''}
                onChange={this.handleDescriptionChange}
            />
        </div>
        <div className="images-image">
          <img src={element.imgUrl} />
        </div>
        <div className="images-image">
          <UploadButton 
            index={index}
            onClick={this.uploadHandler}
          />
        </div>
        <DeleteButton onClick={this.deleteButtonHandler} index={index} />
      </div>);
    });
  }

  addItem = () => {
    const imageBlocks = [
      ...this.state.imageBlocks, {
          title: '',
          imgUrl: '',
          iconUrl: '',
          text: '',
          value: '',
          description: ''
      }
    ];

    this.setState({ 
      ...this.state,
      imageBlocks
    });
  }

  deleteButtonHandler = (index) => {
    const imageBlocks = this.state.imageBlocks;
    imageBlocks.splice(index, 1); 
    this.setState({ imageBlocks });
  }

  uploadHandler = (index, url) => {
    this.state.imageBlocks[index].imgUrl = url;
    this.setState(() => ({ imageBlocks: this.state.imageBlocks }));
  }

  uploadIconHandler = (index, url) => {
    this.state.imageBlocks[index].iconUrl = url;
    this.setState(() => ({ imageBlocks: this.state.imageBlocks }));
  }

  handleTextareaChange = (index, name, value) => {
    this.state.imageBlocks[index].text = value;
    this.setState(() => ({ imageBlocks: this.state.imageBlocks }));
  }

  handleInputChange = (index, name, value) => {
    this.state.imageBlocks[index].title = value;
    this.setState(() => ({ imageBlocks: this.state.imageBlocks }));
  }

  handleValueChange = (index, name, value) => {
    this.state.imageBlocks[index].value = value;
    this.setState(() => ({ imageBlocks: this.state.imageBlocks }));
  }

  handleDescriptionChange = (index, name, value) => {
    this.state.imageBlocks[index].description = value;
    this.setState(() => ({ imageBlocks: this.state.imageBlocks }));
  }

  render () {
    return (
      <div className="item">
        <div className="content">
          {this.imageBlocks()}
          <AddItemButton onClick={this.addItem} />
          <input name={this.props.name} type="hidden" value={JSON.stringify(this.state.imageBlocks)}></input>
        </div>
      </div>
    );
  }
}
