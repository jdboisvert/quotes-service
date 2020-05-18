import axios from "axios";
import React, { Component } from "react";
import { Link, withRouter } from "react-router-dom";
import QuoteDisplay from "./QuoteDisplay";

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
                                <ul className="list-group list-group-flush">
                                    {quotes.map(quote => (
                                        <Link
                                            className="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
                                            to={`/${quote.id}`}
                                            key={quote.id}
                                        >
                                            <QuoteDisplay
                                                quote={quote.quote}
                                                authorName={quote.author_name}
                                            />
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

export default withRouter(QuoteList);
