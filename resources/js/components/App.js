import React, { Component } from "react";
import ReactDOM from "react-dom";
import { BrowserRouter, Route, Switch } from "react-router-dom";
import Header from "./Header";
import Footer from "./Footer";
import QuoteList from "./QuoteList";
import QuoteForm from "./QuoteForm";
import QuoteDetails from "./QuoteDetails";

class App extends Component {
    render() {
        return (
            <BrowserRouter>
                <div>
                    <Header />
                    <Switch>
                        <Route exact path="/" component={QuoteList} />
                        <Route exact path="/create" component={QuoteForm} />
                        <Route exact path="/update/:id" component={QuoteForm} />
                        <Route exact path="/:id" component={QuoteDetails} />
                        {/* <Route exact path="/update/:id" component={QuoteForm} /> */}
                    </Switch>
                    <Footer />
                </div>
            </BrowserRouter>
        );
    }
}

ReactDOM.render(<App />, document.getElementById("app"));
