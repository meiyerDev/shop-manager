import { createContext, useContext, useReducer } from "react";
import {
    ACTION_LOGIN,
    ACTION_SIGNUP
} from '../constants/auth';
import auth from "../services/auth";
import { toast } from "react-toastify";

const AuthContext = createContext();

function authReducer(state, action) {
    switch (action.type) {
        case ACTION_LOGIN:
            return {
                ...state,
                isAuth: true,
                user: action.payload
            };
        default: {
            throw new Error(`Unhandled action type: ${action.type}`);
        }
    }
}

function AuthProvider({ children }) {
    const [state, dispatch] = useReducer(authReducer, {
        isAuth: false,
        user: null,
        errors: {
            email: '',
            password: '',
        }
    });

    const actions = {
        login: async (fields) => {
            try {
                const response = await auth.login(fields);
                dispatch({
                    type: ACTION_LOGIN,
                    payload: response.data.data
                });
            } catch (err) {
                const data = err.response.data;
                if (data.code === 422) {
                    for (const key in data.error) {
                        if (Object.prototype.hasOwnProperty.call(error, key)) {
                            const element = error[key];
                            dispatch({
                                type: ADD_ERROR_BY_VALIDATION,
                                payload: {
                                    [key]: element[0]
                                }
                            });
                        }
                    }
                    return;
                }
                toast.error("Ups! sorry, try again later")
            }
        }
    }

    const value = { state, actions };
    return <AuthContext.Provider value={value}>{children}</AuthContext.Provider>;
}

function useAuth(callback) {
    const context = useContext(AuthContext);
    if (context === undefined) {
        throw new Error("useAuth must be used within a AuthProvider");
    }
    if (callback === undefined) return context;
    return callback(context.state);
}

export { AuthProvider, useAuth };