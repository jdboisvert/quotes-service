import axios from "axios";
import React, { Component } from "react";
import { Link } from "react-router-dom";

class QuoteList extends Component {
    constructor() {
        super();
        this.state = {
            quotes: []
        };
    }

    /**
     * Preload all the quotes
     */
    componentDidMount() {
        axios.get("/api/quotes").then(response => {
            this.setState({
                quotes: response.data.quotes
            });
        });
    }

    render() {
        const { quotes } = this.state;
        return (
            <div className="container py-4">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-header">Quotes</div>
                            <div className="card-body">
                                <Link
                                    className="btn btn-primary btn-sm mb-3"
                                    to="/create"
                                >
                                    Create new quote
                                </Link>
                                <ul className="list-group list-group-flush">
                                    {quotes.map(quote => (
                                        <Link
                                            className="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                            to={`/${quote.id}`}
                                            key={quote.id}
                                        >
                                            <blockquote className="blockquote">
                                                <p className="mb-0">
                                                    {quote.quote}
                                                </p>
                                                <footer className="blockquote-footer">
                                                    by{" "}
                                                    <cite title="Source Title">
                                                        {quote.author_name}
                                                    </cite>
                                                </footer>
                                            </blockquote>
                                        </Link>
                                    ))}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default QuoteList;
