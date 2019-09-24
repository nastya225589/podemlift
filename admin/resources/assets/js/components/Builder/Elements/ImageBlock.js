import React, { Component } from 'react';
import Input from './Input';
import DeleteButton from './DeleteButton';
import AddItemButton from './AddItemButton';
import UploadButton from './UploadButton';
import TinyMce from './TinyMce';
import MoveButton from './MoveButton';

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
        <div className="controls">
          <div className="col">
            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index - 1}
              total={this.state.imageBlocks.length}
            />
            <DeleteButton onClick={this.deleteButtonHandler} index={index} />
            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index + 1}
              total={this.state.imageBlocks.length}
            />
          </div>
        </div>
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
    const imageBlocks = [...this.state.imageBlocks];
    imageBlocks[index].imgUrl = url;
    this.setState(() => ({ imageBlocks: imageBlocks }));
  }

  uploadIconHandler = (index, url) => {
    const imageBlocks = [...this.state.imageBlocks];
    imageBlocks[index].iconUrl = url;
    this.setState(() => ({ imageBlocks: imageBlocks }));
  }

  handleTextareaChange = (index, name, value) => {
    const imageBlocks = [...this.state.imageBlocks];
    imageBlocks[index].text = value;
    this.setState(() => ({ imageBlocks: imageBlocks }));
  }

  handleInputChange = (index, name, value) => {
    const imageBlocks = [...this.state.imageBlocks];
    imageBlocks[index].title = value;
    this.setState(() => ({ imageBlocks: imageBlocks }));
  }

  handleValueChange = (index, name, value) => {
    const imageBlocks = [...this.state.imageBlocks];
    imageBlocks[index].value = value;
    this.setState(() => ({ imageBlocks: imageBlocks }));
  }

  handleDescriptionChange = (index, name, value) => {
    const imageBlocks = [...this.state.imageBlocks];
    imageBlocks[index].description = value;
    this.setState(() => ({ imageBlocks: imageBlocks }));
  }

  moveHandler = (currentIndex, newIndex) => {
    this.setState(currentState => {
      const imageBlocks = currentState.imageBlocks;
      const imageBlock = imageBlocks.splice(currentIndex, 1)[0];
      imageBlocks.splice(newIndex, 0, imageBlock);

      return { imageBlocks: imageBlocks };
    });
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
