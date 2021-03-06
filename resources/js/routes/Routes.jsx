import React, { useEffect } from 'react'
import {
  BrowserRouter as Router,
  Switch,
  Route
} from "react-router-dom";
import RoutePrivate from '../components/AuthRoutes/RoutePrivate';
import { useAuth } from '../contexts/auth-context';
import AdminListOrdersView from '../views/Admin/AdminListOrdersView';
import HomeView from '../views/Home/HomeView';
import CreateOrderView from '../views/Orders/CreateOrderView';
import ListOrdersView from '../views/Orders/ListOrdersView';
import ShowOrderView from '../views/Orders/ShowOrderView';
import ApprovedOrder from '../views/PlacetoPay/ApprovedOrder';
import CanceledOrder from '../views/PlacetoPay/CanceledOrder';
import PendingOrder from '../views/PlacetoPay/PendingOrder';

const Routes = () => {
  const { state, actions } = useAuth();

  useEffect(() => {
    actions.getAuth();
  }, []);

  if (state.loading) return <div>loading...</div>

  return (
    <Switch>
      <Route path="/" exact>
        <HomeView />
      </Route>
      <RoutePrivate path="/orders/create" exact component={CreateOrderView} />
      <RoutePrivate path="/orders/:orderId/placeto-pay/canceled" exact component={CanceledOrder} />
      <RoutePrivate path="/orders/:orderId/placeto-pay/successful" exact component={ApprovedOrder} />
      <RoutePrivate path="/orders/:orderId/placeto-pay/pending" exact component={PendingOrder} />
      <RoutePrivate path="/orders/:orderId" exact component={ShowOrderView} />
      <RoutePrivate path="/orders" exact component={ListOrdersView} />
      <RoutePrivate path="/admin/orders" exact component={AdminListOrdersView} onlyAdmin />
    </Switch>
  );
}

export default Routes
