import React, { Component } from 'react';
import AddElementButton from './AddElementButton';
import TinyMce from './TinyMce';
import Images from './Images';

export default class TwoCols extends Component {
  constructor (props) {
    super(props);

    this.allowedElements = [
      { type: 'tinymce', name: 'Текст' },
      { type: 'images', name: 'Галерея' }
    ];

    const defaultElements = [
      { type: '', content: '' },
      { type: '', content: '' }
    ];

    this.state = { elements: this.props.content || defaultElements };

    this.AddElementButtonHandler = this.AddElementButtonHandler.bind(this);
    this.TinyMceHandler = this.TinyMceHandler.bind(this);
    this.ImagesHandler = this.ImagesHandler.bind(this);
  }

  updateParentState () {
    this.props.onChange(this.props.index, this.state.elements);
  }

  AddElementButtonHandler (index, type) {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].type = type;
      return { elements: elements };
    }, () => this.updateParentState());
  }

  TinyMceHandler (index, name, value) {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = value;
      return { elements: elements };
    }, () => this.updateParentState());
  }

  ImagesHandler (index, content) {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = content;
      return { elements: elements };
    }, () => this.updateParentState());
  }

  element (element, index) {
    if (element.type === '') {
      return <AddElementButton
        onClick={this.AddElementButtonHandler}
        index={index}
        allowedElements={this.allowedElements}
      />;
    }

    if (element.type === 'tinymce') {
      return <TinyMce
        key={`tiny_${this.props.index}_${index}`}
        id={`tiny_${this.props.index}_${element.id}`}
        value={element.content}
        index={index}
        name="content"
        onChange={this.TinyMceHandler}
      />;
    }

    if (element.type === 'images') {
      return <Images
        index={index}
        content={element.content}
        cols="3"
        onChange={this.ImagesHandler}
      />;
    }
  }

  render () {
    return (
      <div className="two-cols">
        {this.state.elements.map((element, index) => {
          return (
            <div key={index} className="col">
              {this.element(element, index)}
            </div>
          );
        })}
      </div>
    );
  }
}
