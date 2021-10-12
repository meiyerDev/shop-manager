import { createContext, useContext, useReducer } from "react";
import {
    ACTION_GET_PRODUCT_LIST
} from '../constants/product';
import products from "../services/products";

const ProductContext = createContext();

function productReducer(state, action) {
    switch (action.type) {
        case ACTION_GET_PRODUCT_LIST:
            return {
                ...state,
                products: action.payload
            };
        default: {
            throw new Error(`Unhandled action type: ${action.type}`);
        }
    }
}

function ProductProvider({ children }) {
    const [state, dispatch] = useReducer(productReducer, {
        products: []
    });

    const actions = {
        fetchProducts: async () => {
            const response = await products.fetchProducts();
            dispatch({
                type: ACTION_GET_PRODUCT_LIST,
                payload: response.data.data.data
            });
        }
    }

    const value = { state, actions };
    return <ProductContext.Provider value={value}>{children}</ProductContext.Provider>;
}

function useProduct(callback) {
    const context = useContext(ProductContext);
    if (context === undefined) {
        throw new Error("useProduct must be used within a ProductProvider");
    }
    if (callback === undefined) return context;
    return callback(context.state);
}

export { ProductProvider, useProduct };