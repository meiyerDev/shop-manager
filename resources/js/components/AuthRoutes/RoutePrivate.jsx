import React, { useEffect } from 'react'
import { useAuth } from '../../contexts/auth-context';
import { Route } from 'react-router-dom';
import { Redirect } from 'react-router-dom/cjs/react-router-dom.min';

const RoutePrivate = ({ component: Component, exact, path }) => {
    const { state: { isAuth }, actions } = useAuth();

    return (
        <Route
            exact={!!exact}
            path={path}
            render={(props) => {
                if (isAuth) return <Component />;

                return <Redirect to="/" from={path} />;
            }}
        />
    );

}

export default RoutePrivate
