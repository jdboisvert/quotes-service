import React, { Component } from "react";

/**
 * Used handle displaying a quote.
 */
class QuoteDisplay extends Component {
    render() {
        return (
            <blockquote className="blockquote">
                <p className="mb-0">{this.props.quote}</p>
                <footer className="blockquote-footer">
                    by <cite title="Source Title">{this.props.authorName}</cite>
                </footer>
            </blockquote>
        );
    }
}

export default QuoteDisplay;
