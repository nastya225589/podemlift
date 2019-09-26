import React, { Component } from 'react'
import Input from './Input'
import TextArea from './TextArea'
import DeleteButton from './DeleteButton'
import AddItemButton from './AddItemButton'
import MoveButton from './MoveButton';

export default class QA extends Component {
  constructor (props) {
    super(props);

    this.state = {
      elements: this.props.value
    };
  }

  elements = () => {
    return this.state.elements.map((element, index) => {      
      return (
      <div key={index}>
        <div className="col">
          <label>Вопрос</label>
          <Input
            index={index}
            value={element.question}
            onChange={this.handleQuestionChange}
          />
        </div>
        <div className="col">
          <label>Ответ</label>
          <TextArea
            index={index}
            value={element.answer}
            onChange={this.handleAnswerChange}
          />
        </div>
        <div className="controls">
          <div className="col">
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
      </div>);
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

  addItem = () => {
    const elements = [
      ...this.state.elements, {
        question: '',
        answer: '',
      }
    ];

    this.setState({ 
      ...this.state,
      elements
    });
  }

  deleteButtonHandler = (index) => {
    const elements = this.state.elements;
    elements.splice(index, 1); 
    this.setState({ elements });
  }

  handleQuestionChange = (index, name, value) => {
    const elements = this.state.elements;
    elements[index].question = value;
    this.setState(() => ({ elements: elements }));
  }

  handleAnswerChange = (index, name, value) => {
    const elements = this.state.elements;
    elements[index].answer = value;
    this.setState(() => ({ elements: elements }));
  }

  render () {
    return (
      <div className="item">
        <div className="content">
          {this.elements()}
          <AddItemButton onClick={this.addItem} />
          <input name={this.props.name} type="hidden" value={JSON.stringify(this.state.elements)}></input>
        </div>
      </div>
    );
  }
}
