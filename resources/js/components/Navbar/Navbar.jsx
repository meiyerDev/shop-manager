import React from 'react'
import { NavLink } from 'react-router-dom'
import { useAuth } from '../../contexts/auth-context';
import ModalAuth from '../ModalAuth/ModalAuth'

const Navbar = () => {
    const { state, actions } = useAuth();
    return (
        <nav className="bg-white shadow-lg">
            <div className="max-w-6xl mx-auto px-4">
                <div className="flex justify-between">
                    <div className="flex space-x-7">
                        <div>
                            <a href="#" className="flex items-center py-4 px-2">
                                <span className="font-semibold text-gray-500 text-lg">
                                    Navigation
                                </span>
                            </a>
                        </div>
                        <div className="flex items-center space-x-1">
                            <NavLink
                                exact
                                to="/"
                                className="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300"
                                activeClassName="text-green-500 border-b-4 border-green-500"
                            >
                                Home
                            </NavLink>
                            {state.isAuth && (
                                <NavLink
                                    to="/orders"
                                    className="py-4 px-2 text-gray-500 font-semibold hover:text-green-500 transition duration-300"
                                    activeClassName="text-green-500 border-b-4 border-green-500"
                                >
                                    Orders
                                </NavLink>
                            )}
                        </div>
                    </div>
                    <div className="flex items-center">
                        {!state.isAuth && (
                            <ModalAuth />
                        )}
                    </div>
                </div>
            </div>
        </nav>
    )
}

export default Navbar
