import React from 'react'
import {
  BrowserRouter as Router,
  Switch,
  Route
} from "react-router-dom";
import HomeView from '../views/Home/HomeView';
import CreateOrderView from '../views/Orders/CreateOrderView';
import ListOrdersView from '../views/Orders/ListOrdersView';

const Routes = () => {
  return (
    <Switch>
      <Route path="/" exact>
        <HomeView />
      </Route>
      <Route path="/orders/create" exact>
        <CreateOrderView />
      </Route>
      <Route path="/orders" exact>
        <ListOrdersView />
      </Route>
    </Switch>
  );
}

export default Routes
