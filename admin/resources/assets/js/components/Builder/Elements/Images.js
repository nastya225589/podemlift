import React, {Component} from 'react';
import { SortableContainer, SortableElement, sortableHandle, arrayMove} from 'react-sortable-hoc';
import UploadButton from './UploadButton';
import DeleteButton from "./DeleteButton";


const DragHandle = sortableHandle(({element}) => <img src={element.url} alt=""/>);

const SortableItem = SortableElement(({itemIndex, element, deleteButtonHandler}) => {
    return (
        <div className="images-image">
            <DragHandle element={element}/>
            <DeleteButton onClick={deleteButtonHandler} index={itemIndex} />
        </div>
    )
});

const SortableList = SortableContainer(({elements, uploadHandler, deleteButtonHandler, cols}) => {
    return (
        <div className={`images cols-${cols}`}>
            {elements.map((element, index) => {
                return (
                    <SortableItem
                        key={`element-${element.id}`}
                        index={index}
                        itemIndex={index}
                        element={element}
                        deleteButtonHandler={deleteButtonHandler}
                    />
                )
            })}
            <div className="images-image">
                <UploadButton onClick={uploadHandler} />
            </div>
        </div>
    );
});

export default class Images extends Component {
    constructor(props) {
        super(props);

        this.state = {
            elements: this.props.content || []
        };

        this.onSortEnd = this.onSortEnd.bind(this);
        this.uploadHandler = this.uploadHandler.bind(this);
        this.deleteButtonHandler = this.deleteButtonHandler.bind(this);
    }

    updateParentState() {
        this.props.onChange(this.props.index, this.state.elements);
    }

    onSortEnd({oldIndex, newIndex}) {
        this.setState({
            elements: arrayMove(this.state.elements, oldIndex, newIndex),
        }, () => this.updateParentState());
    }

    uploadHandler(index, url) {
        this.setState(currentState => {
            let elements = currentState.elements;
            let id = elements.length ? _.maxBy(elements, 'id').id + 1 : 1;
            elements = [...elements, {id: id, url: url}];
            return { elements: elements };
        }, () => this.updateParentState());
    }

    deleteButtonHandler(index) {
        this.setState(currentState => {
            let elements = currentState.elements;
            elements.splice(index, 1);
            return { elements: elements };
        }, () => this.updateParentState());
    }

    render() {
        return <SortableList
                    elements={this.state.elements}
                    onSortEnd={this.onSortEnd}
                    uploadHandler={this.uploadHandler}
                    deleteButtonHandler={this.deleteButtonHandler}
                    cols={this.props.cols}
                    axis="xy"
                    useDragHandle
                />;
    }
}