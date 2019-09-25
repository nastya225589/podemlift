import React, { Component } from 'react';
import Input from './Input';
import DeleteButton from './DeleteButton';
import AddItemButton from './AddItemButton';
import UploadButton from './UploadButton';
import MoveButton from './MoveButton';

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
        <div className="controls">
          <div className="col">
            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index - 1}
              total={this.state.icons.length}
            />
            <DeleteButton onClick={this.deleteButtonHandler} index={index} />
            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index + 1}
              total={this.state.icons.length}
            />
          </div>
        </div>
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

  moveHandler = (currentIndex, newIndex) => {
    this.setState(currentState => {
      const icons = currentState.icons;
      const icon = icons.splice(currentIndex, 1)[0];
      icons.splice(newIndex, 0, icon);

      return { icons: icons };
    });
  }

  deleteButtonHandler = (index) => {
    const icons = this.state.icons;
    icons.splice(index, 1); 
    this.setState({ icons });
  }

  uploadHandler = (index, url) => {
    const icons = [...this.state.icons];
    icons[index].imgUrl = url;
    this.setState(() => ({ icons: icons }));
  }

  handleInputChange = (index, name, value) => {
    const icons = [...this.state.icons];
    icons[index].title = value;
    this.setState(() => ({ icons: icons }));
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
