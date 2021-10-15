import { createContext, useContext, useReducer } from "react";
import {
    ACTION_ADD_FIELDS_TO_FORM_CREATE_ORDER, ACTION_ADD_ORDER_TO_LIST, ACTION_ADD_ORDER, ADD_ERROR_BY_VALIDATION, ACTION_ADD_ORDERS_LIST
} from '../constants/order';
import orders from "../services/orders";
import { toast } from "react-toastify";
import { useHistory } from "react-router-dom/cjs/react-router-dom.min";
import ButtonPrimary from "../components/Button/ButtonPrimary";

const OrderContext = createContext();

function orderReducer(state, action) {
    switch (action.type) {
        case ACTION_ADD_FIELDS_TO_FORM_CREATE_ORDER:
            return {
                ...state,
                fields: { ...state.fields, ...action.payload }
            };
        case ACTION_ADD_ORDER_TO_LIST:
            return {
                ...state,
                orders: [action.payload, ...state.orders]
            };
        case ADD_ERROR_BY_VALIDATION:
            return {
                ...state,
                errors: {
                    ...state.errors,
                    ...action.payload
                }
            };
        case ACTION_ADD_ORDERS_LIST:
            return {
                ...state,
                orders: action.payload,
            };
        case ACTION_ADD_ORDER:
            return {
                ...state,
                order: action.payload
            }
        default: {
            throw new Error(`Unhandled action type: ${action.type}`);
        }
    }
}

function OrderProvider({ children }) {
    const [state, dispatch] = useReducer(orderReducer, {
        fields: {
            customer_email: "",
            customer_name: "",
            customer_mobile: "",
            product_id: "",
            product: null,
        },
        errors: {
            customer_email: "",
            customer_name: "",
            customer_mobile: "",
        },
        orders: [],
        order: null
    });

    let history = useHistory();

    const actions = {
        setFormFieldsToCreate: (fields) => {
            dispatch({
                type: ACTION_ADD_FIELDS_TO_FORM_CREATE_ORDER,
                payload: fields,
            })
        },
        postCreate: async (fields) => {
            delete fields.product;
            try {
                const response = await orders.createOrder(fields);
                dispatch({
                    type: ACTION_ADD_ORDER_TO_LIST,
                    payload: response.data.data
                });
                toast.success("You have completed the order!")
                history.push('/orders');
            } catch (err) {
                const data = err.response.data;
                console.log(data)
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
        getByAuth: async () => {
            const response = await orders.getAuthOrders();
            dispatch({
                type: ACTION_ADD_ORDERS_LIST,
                payload: response.data.data.data
            });
        },
        getById: async (id) => {
            try {
                const response = await orders.getOrderById(id);
                console.log(response.data)
                dispatch({
                    type: ACTION_ADD_ORDER,
                    payload: response.data.data
                })
            } catch (err) {
                const data = err.response.data;
                if (data.code === 403) {
                    toast.error("Ups! this order doesn't exists");
                }
                history.push('/orders');
                toast.error("Ups! sorry, try again later")
            }
        },
        checkoutPlacetoPay: async (id) => {
            let toastId = toast.loading("Processing, please wait ...")
            try {
                const response = await orders.createPlacetoPay(id);
                toast.update(toastId, {
                    render: "Order ready to proceed to payment, you will redirect to Placeto Pay",
                    style: { display: 'block' },
                    type: toast.TYPE.SUCCESS,
                    isLoading: false,
                    closeButton: ({ closeToast }) => {
                        return (
                            <div className="text-right">
                                <ButtonPrimary text="Got it!" className="text-xs" onClick={() => {
                                    window.location.href = response.data.data.process_url;
                                    closeToast();
                                }} />
                            </div>
                        )
                    }
                })
            } catch (err) {
                toast.update(toastId, {
                    render: "Ups! sorry, try again later",
                    type: toast.TYPE.ERROR,
                    isLoading: false
                })
            }
        }
    }

    const value = { state, actions };
    return <OrderContext.Provider value={value}>{children}</OrderContext.Provider>;
}

function useOrder(callback) {
    const context = useContext(OrderContext);
    if (context === undefined) {
        throw new Error("useOrder must be used within a OrderProvider");
    }
    if (callback === undefined) return context;
    return callback(context.state);
}

export { OrderProvider, useOrder };
