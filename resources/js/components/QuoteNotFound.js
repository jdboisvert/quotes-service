import React, { Component } from "react";
import { withRouter } from "react-router-dom";

/**
 * Used handle displaying error page when quote is not found.
 */
class QuoteNotFound extends Component {
    render() {
        return (
            <div className="container">
                <div className="row">
                    <div className="col-md-12">
                        <div className="text-center">
                            <h1>Oops!</h1>
                            <h2>404 Not Found</h2>
                            <h4>
                                That quote you are looking for does not exist.
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

export default withRouter(QuoteNotFound);
