import React, { Component } from 'react';
import Input from './Input';
import DeleteButton from './DeleteButton';
import AddItemButton from './AddItemButton';
import UploadButton from './UploadButton';
import MoveButton from './MoveButton';

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
        <div className="controls">
          <div className="col">
            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index - 1}
              total={this.state.iconsInline.length}
            />
            <DeleteButton onClick={this.deleteButtonHandler} index={index} />
            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index + 1}
              total={this.state.iconsInline.length}
            />
          </div>
        </div>
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
    const iconsInline = [...this.state.iconsInline];
    iconsInline[index].imgUrl = url;
    this.setState(() => ({ iconsInline: iconsInline }));
  }

  uploadBackgroundHandler = (index, url) => {
    this.setState(() => ({ imgUrl: url }));
  }

  handleInputChange = (index, name, value) => {
    const iconsInline = [...this.state.iconsInline];
    iconsInline[index].title = value;
    this.setState(() => ({ iconsInline: iconsInline }));
  }

  moveHandler = (currentIndex, newIndex) => {
    this.setState(currentState => {
      const iconsInline = currentState.iconsInline;
      const icon = iconsInline.splice(currentIndex, 1)[0];
      iconsInline.splice(newIndex, 0, icon);

      return { iconsInline: iconsInline };
    });
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
