import React from "react";
import { Link } from "react-router-dom";

const Header = () => (
    <nav className="navbar navbar-expand-md navbar-light navbar-laravel">
        <div className="container">
            <Link className="navbar-brand" to="/">
                Quotes Collection
            </Link>
            <div>
                <ul className="nav navbar-nav mr-auto">
                    <li className="navbar-item">
                        <Link className="navbar-link" to="/">
                            View All Quotes
                        </Link>
                    </li>
                    <li className="navbar-item">
                        <Link className="navbar-link" to="/create">
                            Create Quote
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
);

export default Header;
