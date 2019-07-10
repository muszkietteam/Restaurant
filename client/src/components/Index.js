import React, { Component } from "react";
import { Jumbotron, Button } from "reactstrap";
import { NavLink } from "react-router-dom";
import "./Index.css";

class Index extends Component {
  render() {
    return (
      <>
        <Jumbotron>
          <h1 className="display-3">Witaj na stronie restauracji!</h1>
          <hr className="my-2" />
          <p>U nas zamówisz tanie i dobre jedzenie!</p>
          <p className="lead">
            <Button color="primary">
              <NavLink to="/menu">Zamów żarcie!</NavLink>
            </Button>
          </p>
        </Jumbotron>
      </>
    );
  }
}

export default Index;
