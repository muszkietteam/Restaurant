import React from "react";
import "./App.css";
import NavbarApp from "./components/NavbarApp";
import { BrowserRouter as Router, Route } from "react-router-dom";
import Index from "./components/Index";
import RestaurantMenu from "./components/RestaurantMenu";
import Contact from "./components/Contact";

function App() {
  return (
    <Router>
      <NavbarApp />
      <div className="container">
        <Route path="/" exact component={Index} />
        <Route path="/menu/" component={RestaurantMenu} />
        <Route path="/contact/" component={Contact} />
      </div>
    </Router>
  );
}

export default App;
