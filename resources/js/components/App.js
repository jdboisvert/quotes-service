import React, { Component } from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch } from "react-router-dom";
import Header from "./Header";
import QuoteList from "./QuoteList";
import QuoteCreateForm from "./QuoteCreateForm";
import QuoteDetails from "./QuoteDetails";

class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <Header />
                    <Switch>
                        <Route exact path="/" component={QuoteList} />
                        <Route
                            exact
                            path="/create"
                            component={QuoteCreateForm}
                        />
                        <Route exact path="/:id" component={QuoteDetails} />
                        <Route
                            exact
                            path="/update/:id"
                            component={QuoteCreateForm}
                        />
                    </Switch>
                </div>
            </BrowserRouter>
        );
    }
}

ReactDOM.render(<App />, document.getElementById("app"));
