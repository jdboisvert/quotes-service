import axios from "axios";
import React, { Component } from "react";

/**
 * Used to handle creating a form.
 */
class QuoteCreateForm extends Component {
    constructor(props) {
        super(props);
        this.state = {
            quote: "",
            authorName: "",
            error: ""
        };
        this.handleFieldChange = this.handleFieldChange.bind(this);
        this.handleCreateQuote = this.handleCreateQuote.bind(this);
        this.renderError = this.renderError.bind(this);
    }

    handleFieldChange(event) {
        this.setState({
            [event.target.name]: event.target.value
        });
    }

    handleCreateQuote(event) {
        event.preventDefault();
        const { history } = this.props;

        const quote = {
            quote: this.state.quote,
            author_name: this.state.authorName
        };
        axios
            .post("/api/quote", quote)
            .then(response => {
                // redirect to the homepage
                history.push("/");
            })
            .catch(error => {
                this.setState({
                    error: error.response.data.message
                });
            });
    }

    renderError() {
        if (!!this.state.error) {
            return (
                <div className="alert alert-danger" role="alert">
                    <strong>{this.state.error}</strong>
                </div>
            );
        }
    }

    render() {
        return (
            <div className="container py-4">
                <div className="row justify-content-center">
                    <div className="col-md-6">
                        <div className="card">
                            <div className="card-header">
                                Enter the details below to create a new quote.
                            </div>
                            <div className="card-body">
                                {this.renderError()}
                                <form onSubmit={this.handleCreateQuote}>
                                    <div className="form-group">
                                        <label htmlFor="quote">Quote</label>
                                        <textarea
                                            id="quote"
                                            type="text"
                                            className={`form-control`}
                                            rows="10"
                                            name="quote"
                                            maxlength="500"
                                            value={this.state.quote}
                                            onChange={this.handleFieldChange}
                                        />
                                    </div>
                                    <div className="form-group">
                                        <label htmlFor="author-name">
                                            Author Name
                                        </label>
                                        <input
                                            id="author-name"
                                            className={`form-control`}
                                            name="authorName"
                                            maxLength="255"
                                            value={this.state.authorName}
                                            onChange={this.handleFieldChange}
                                        />
                                    </div>
                                    <button className="btn btn-primary">
                                        Create
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default QuoteCreateForm;
