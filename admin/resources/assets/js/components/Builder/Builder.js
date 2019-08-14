import React, { Component } from 'react';
import AddElementButton from './Elements/AddElementButton';
import MoveButton from './Elements/MoveButton';
import DeleteButton from './Elements/DeleteButton';
import TinyMce from './Elements/TinyMce';
import TwoCols from './Elements/TwoCols';
import Images from './Elements/Images';
import Subtitle from './Elements/Subtitle';

export default class Builder extends Component {
  constructor (props) {
    super(props);
    this.state = { elements: JSON.parse(this.props.value) };

    this.AddElementButtonHandler = this.AddElementButtonHandler.bind(this);
    this.TinyMceHandler = this.TinyMceHandler.bind(this);
    this.TwoColsHandler = this.TwoColsHandler.bind(this);
    this.ImagesHandler = this.ImagesHandler.bind(this);
    this.moveHandler = this.moveHandler.bind(this);

    this.allowedElements = [
      { type: 'tinymce', name: 'Текст' },
      { type: 'two_cols', name: 'Две колонки' },
      { type: 'images', name: 'Галерея' },
      { type: 'subtitle', name: 'Подзаголовок с картинкой' }
    ];
  }

  AddElementButtonHandler (index, type) {
    this.setState(currentState => {
      const elements = currentState.elements;
      const id = elements.length ? _.maxBy(elements, 'id').id + 1 : 1;
      elements.splice(index, 0, { id: id, type: type, content: '' });
      return { elements: elements };
    });
  }

  TinyMceHandler (index, name, value) {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = value;
      return { elements: elements };
    });
  }

  TwoColsHandler (index, content) {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = content;
      return { elements: elements };
    });
  }

  ImagesHandler (index, content) {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = content;
      return { elements: elements };
    });
  }

  subtitleHandler = (index, name, content) => {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = content;
      return { elements: elements };
    });    
  }

  moveHandler (currentIndex, newIndex) {
    this.setState(currentState => {
      const elements = currentState.elements;
      const element = elements.splice(currentIndex, 1)[0];

      elements.splice(newIndex, 0, element);

      return { elements: elements };
    });
  }

  deleteButtonHandler = (index) => {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements.splice(index, 1);
      return { elements: elements };
    });
  };

  element (element, index) {
    if (element.type === 'two_cols') {
      return <TwoCols
        index={index}
        content={element.content}
        onChange={this.TwoColsHandler}
      />;
    }

    if (element.type === 'tinymce') {
      return <TinyMce
        key={`tiny_${index}`}
        id={`tiny_${element.id}`}
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
        cols="5"
        onChange={this.ImagesHandler}
      />;
    }
    if (element.type === 'subtitle') {
      return <Subtitle
        index={index}
        content={element.content}
        name="subtitle"
        onChange={this.subtitleHandler}
      />;
    }
  }

  elements () {
    return this.state.elements.map((element, index) =>
      <div key={element.id} className="element">
        <div className="item">
          <div className="content">
            {this.element(element, index)}
          </div>
          <div className="controls">
            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index - 1}
              total={this.state.elements.length}
            />

            <DeleteButton onClick={this.deleteButtonHandler} index={index} />

            <MoveButton
              onClick={this.moveHandler}
              currentIndex={index}
              newIndex={index + 1}
              total={this.state.elements.length}
            />
          </div>
        </div>

        <AddElementButton onClick={this.AddElementButtonHandler} index={index + 1} allowedElements={this.allowedElements}/>
      </div>
    );
  }

  render () {
    return (
      <div className="builder">
        <AddElementButton onClick={this.AddElementButtonHandler} index={0} allowedElements={this.allowedElements}/>

        {this.elements()}

        <div className="mt-4" style={{ display: 'none' }}>
          <textarea
            name={this.props.name}
            value={JSON.stringify(this.state.elements)}
            readOnly
            className="form-control"
            rows="10"
          ></textarea>
        </div>
      </div>
    );
  }
}
