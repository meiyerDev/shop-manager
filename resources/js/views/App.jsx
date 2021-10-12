import React from 'react'
import {
    BrowserRouter as Router,
} from "react-router-dom";
import ReactDOM from 'react-dom';
import Layout from '../components/Layout/Layout'
import Routes from '../routes/Routes';
import { OrderProvider } from '../contexts/order-context';
import { ToastContainer } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';
import { AuthProvider } from '../contexts/auth-context';

const App = () => {
    return (
        <Router>
            <ToastContainer />
            <AuthProvider>
                <OrderProvider>
                    <Layout>
                        <Routes />
                    </Layout>
                </OrderProvider>
            </AuthProvider>
        </Router>
    )
}

export default App

if (document.getElementById('app')) {
    ReactDOM.render(<App />, document.getElementById('app'));
}
