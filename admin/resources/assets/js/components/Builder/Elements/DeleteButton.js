import React, { Component } from 'react';

export default class DeleteButton extends Component {
    constructor(props) {
        super(props);

        this.onClick = this.onClick.bind(this);
    }

    onClick() {
        this.props.onClick(this.props.index);
    }

    render() {
        return (
            <div className="delete">
                <i className="far fa-trash-alt" onClick={this.onClick}></i>
            </div>
        )
    }
}