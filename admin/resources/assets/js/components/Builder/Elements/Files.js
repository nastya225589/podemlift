import React, { Component } from 'react';
import Input from './Input';
import DeleteButton from './DeleteButton';
import AddItemButton from './AddItemButton';
import UploadFileButton from './UploadFileButton';
import MoveButton from './MoveButton';

export default class Files extends Component {
  constructor (props) {
    super(props);

    this.state = {
      files: this.props.value
    };
  }

  files = () => {
    return this.state.files.map((element, index) => {      
      return (
      <div className="two-cols" key={index}>
        <div className="images cols-5">
          <div className="images-image">
              {element.path ? <i className="fa-5x fas fa-file"></i> : ''}
          </div>
          <div className="images-image">
            <UploadFileButton 
              index={index}
              onClick={this.uploadHandler}
            />
          </div>
          <label>Название</label>
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
              total={this.state.files.length}
            />
            <DeleteButton onClick={this.deleteButtonHandler} index={index} />
            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index + 1}
              total={this.state.files.length}
            />
          </div>
        </div>
      </div>);
    });
  }

  addItem = () => {
    const files = [
      ...this.state.files, {
          title: '',
          path: ''
      }
    ];

    this.setState({ 
      ...this.state,
      files
    });
  }

  moveHandler = (currentIndex, newIndex) => {
    this.setState(currentState => {
      const files = currentState.files;
      const icon = files.splice(currentIndex, 1)[0];
      files.splice(newIndex, 0, icon);

      return { files: files };
    });
  }

  deleteButtonHandler = (index) => {
    const files = this.state.files;
    files.splice(index, 1); 
    this.setState({ files });
  }

  uploadHandler = (index, path) => {
    const files = [...this.state.files];
    files[index].path = path;
    this.setState(() => ({ files: files }));
  }

  handleInputChange = (index, name, value) => {
    const files = [...this.state.files];
    files[index].title = value;
    this.setState(() => ({ files: files }));
  }

  render () {
    return (
      <div className="item">
        <div className="content">
          {this.files()}
          <AddItemButton onClick={this.addItem} />
          <input name={this.props.name} type="hidden" value={JSON.stringify(this.state.files)}></input>
        </div>
      </div>
    );
  }
}
