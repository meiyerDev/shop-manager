import { createContext, useContext, useReducer } from "react";
import {
    ACTION_LOGIN,
    ACTION_SIGNUP,
    ACTION_LOGOUT,
    ACTION_AUTH_LOADED,
    ACTION_AUTH_LOADING,
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
        case ACTION_LOGOUT:
            return {
                ...state,
                isAuth: false,
                user: null
            };
        case ACTION_AUTH_LOADING:
            return {
                ...state,
                loading: true,
            }
        case ACTION_AUTH_LOADED:
            return {
                ...state,
                loading: false
            }
        default: {
            throw new Error(`Unhandled action type: ${action.type}`);
        }
    }
}

function AuthProvider({ children }) {
    const [state, dispatch] = useReducer(authReducer, {
        isAuth: false,
        loading: true,
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
        },
        getAuth: async () => {
            dispatch({ type: ACTION_AUTH_LOADING })
            try {
                const response = await auth.getAuth();
                dispatch({
                    type: ACTION_LOGIN,
                    payload: response.data.data
                });
            } catch (err) {
                dispatch({ type: ACTION_LOGOUT });
                toast.error("Ups! sorry, try again later")
            }
            dispatch({ type: ACTION_AUTH_LOADED })
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