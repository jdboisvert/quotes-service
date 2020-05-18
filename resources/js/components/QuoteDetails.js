import axios from "axios";
import React, { Component } from "react";
import { Link, withRouter } from "react-router-dom";
import QuoteDisplay from "./QuoteDisplay";

class QuoteDetails extends Component {
    constructor(props) {
        super(props);
        this.state = {
            quote: {}
        };
        this.handleQuoteDelete = this.handleQuoteDelete.bind(this);
    }

    componentDidMount() {
        const quoteId = this.props.match.params.id;

        axios.get(`/api/quote/details/${quoteId}`).then(response => {
            this.setState({
                quote: response.data.quote
            });
        });
    }

    handleQuoteDelete() {
        const { history } = this.props;

        const quoteId = this.state.quote.id;

        axios.delete(`/api/quote/delete/${quoteId}`).then(response => {
            // redirect to the homepage
            history.push("/");
        });
    }

    render() {
        const { quote } = this.state;

        return (
            <div className="container py-4">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card">
                            <div className="card-body">
                                <div className="text-center">
                                    <QuoteDisplay
                                        quote={quote.quote}
                                        authorName={quote.author_name}
                                    />
                                </div>
                                <hr />
                                <div className="btn-toolbar" role="toolbar">
                                    <div className="mr-2">
                                        <Link
                                            className="btn btn-primary"
                                            to={`/update/${quote.id}`}
                                            key={quote.id}
                                        >
                                            Update
                                        </Link>
                                    </div>
                                    <div className="mr-2">
                                        <button
                                            className="btn btn-danger"
                                            onClick={this.handleQuoteDelete}
                                        >
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default withRouter(QuoteDetails);
