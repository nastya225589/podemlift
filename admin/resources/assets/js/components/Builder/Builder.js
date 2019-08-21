import React, { Component } from 'react';
import AddElementButton from './Elements/AddElementButton';
import MoveButton from './Elements/MoveButton';
import DeleteButton from './Elements/DeleteButton';
import TinyMce from './Elements/TinyMce';
import TwoCols from './Elements/TwoCols';
import Images from './Elements/Images';
import Subtitle from './Elements/Subtitle';
import Header from './Elements/Header';
import ProductFeatures from './Elements/ProductFeatures';
import ProductEquipment from './Elements/ProductEquipment';

export default class Builder extends Component {
  constructor (props) {
    super(props);
    this.state = { elements: JSON.parse(this.props.value) };

    this.allowedElements = this.initAllowedElementsState(allowedElements, this.props.allowed);
  }

  initAllowedElementsState = (elements, allowed) => {  
    if (allowed.length) {
      elements = elements.filter(function( obj ) {
        return allowed.includes(obj.type);
      });
    }
    return elements;
  }

  addElementButtonHandler = (index, type) => {
    this.setState(currentState => {
      const elements = currentState.elements;
      const id = elements.length ? _.maxBy(elements, 'id').id + 1 : 1;
      elements.splice(index, 0, { id: id, type: type, content: '' });
      return { elements: elements };
    });
  }

  tinyMceHandler = (index, name, value) => {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = value;
      return { elements: elements };
    });
  }

  twoColsHandler = (index, content) => {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = content;
      return { elements: elements };
    });
  }

  imagesHandler = (index, content) => {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = content;
      return { elements: elements };
    });
  }

  subtitleHandler = (index, content) => {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = content;
      return { elements: elements };
    });    
  }

  headerHandler = (index, content) => {
    this.setState(currentState => {
      const elements = currentState.elements;
      elements[index].content = content;
      return { elements: elements };
    });    
  }

  moveHandler = (currentIndex, newIndex) => {
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
        onChange={this.twoColsHandler}
      />;
    }

    if (element.type === 'tinymce') {
      return <TinyMce
        key={`tiny_${index}`}
        id={`tiny_${element.id}`}
        value={element.content}
        index={index}
        name="content"
        onChange={this.tinyMceHandler}
      />;
    }

    if (element.type === 'images') {
      return <Images
        index={index}
        content={element.content}
        cols="5"
        onChange={this.imagesHandler}
      />;
    }
    if (element.type === 'subtitle') {
      return <Subtitle
        index={index}
        content={element.content}
        onChange={this.subtitleHandler}
      />;
    }
    if (element.type === 'header') {
      return <Header
        index={index}
        content={element.content}
        onChange={this.headerHandler}
      />;
    }
    if (element.type === 'product_features') {
      return <ProductFeatures
        index={index}
        content={element.content}
      />;
    }
    if (element.type === 'product_equipment') {
      return <ProductEquipment
        index={index}
        content={element.content}
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

        <AddElementButton onClick={this.addElementButtonHandler} index={index + 1} allowedElements={this.allowedElements}/>
      </div>
    );
  }

  render () {
    return (
      <div className="builder">
        <AddElementButton onClick={this.addElementButtonHandler} index={0} allowedElements={this.allowedElements}/>

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

const allowedElements = [
  { type: 'tinymce', name: 'Текст' },
  { type: 'two_cols', name: 'Две колонки' },
  { type: 'images', name: 'Галерея' },
  { type: 'header', name: 'Заголовок' },
  { type: 'subtitle', name: 'Подзаголовок с картинкой' },
  { type: 'product_features', name: 'Преимущества продукта' },
  { type: 'product_equipment', name: 'Оборудование продукта' },
];
