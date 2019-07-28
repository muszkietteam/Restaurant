import React from "react";
import {
  Collapse,
  Navbar,
  NavbarToggler,
  NavbarBrand,
  Nav,
  NavItem,
  Container
} from "reactstrap";
import { NavLink } from "react-router-dom";
import "./NavbarApp.css";

class NavbarApp extends React.Component {
  state = {
    isOpen: false
  };

  toggle = () => {
    this.setState({
      isOpen: !this.state.isOpen
    });
  };
  render() {
    return (
      <div>
        <Navbar color="primary" light expand="md">
          <Container>
            <NavbarBrand className="white" href="/">
              Restaurant
            </NavbarBrand>
            <NavbarToggler onClick={this.toggle} />

            <Collapse isOpen={this.state.isOpen} navbar>
              <Nav className="ml-auto" navbar>
                <NavItem>
                  <NavLink exact={true} to="/">
                    Home
                  </NavLink>
                </NavItem>
                <NavItem>
                  <NavLink to="/menu">Menu</NavLink>
                </NavItem>
                <NavItem>
                  <NavLink to="/contact">Contact</NavLink>
                </NavItem>
              </Nav>
            </Collapse>
          </Container>
        </Navbar>
      </div>
    );
  }
}

export default NavbarApp;
