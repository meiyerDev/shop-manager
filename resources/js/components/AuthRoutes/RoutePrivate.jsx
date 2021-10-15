import React, { useEffect } from 'react'
import { useAuth } from '../../contexts/auth-context';
import { Route } from 'react-router-dom';
import { Redirect } from 'react-router-dom/cjs/react-router-dom.min';

const RoutePrivate = ({ component: Component, exact, path, onlyAdmin }) => {
    const { state: { isAuth, user }, actions } = useAuth();

    return (
        <Route
            exact={!!exact}
            path={path}
            render={(props) => {
                if (isAuth && (!onlyAdmin || user.is_admin)) return <Component />;

                return <Redirect to="/" from={path} />;
            }}
        />
    );

}

export default RoutePrivate
