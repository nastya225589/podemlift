import React, { Component } from 'react';

export default class AddElementButton extends Component {
    constructor(props) {
        super(props);

        this.onClick = this.onClick.bind(this);
    }

    onClick(type) {
        this.props.onClick(this.props.index, type);
    }

    elements() {
        return this.props.allowedElements.map(item => {
            return <div key={item.type} className="item" onClick={() => this.onClick(item.type)}>{item.name}</div>
        })
    }

    render() {
        return (
            <div className="add-element">
                <div className="button">
                    +
                    <div className="items">
                        {this.elements()}
                    </div>
                </div>
            </div>
        );
    }
}