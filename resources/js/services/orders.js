import csrf from "./csrf";
import http from "./http";

const orders = {
    createOrder: async (fields) => {
        await csrf.getCookie()
        return http.post('/api/orders', fields);
    },
    getAuthOrders: async () => {
        await csrf.getCookie()
        return http.get('/api/orders');
    },
    getOrderById: async (id) => {
        await csrf.getCookie()
        return http.get(`/api/orders/${id}`);
    },
    createPlacetoPay: async (id) => {
        await csrf.getCookie();
        return http.post(`/api/orders/${id}/placeto-pay`);
    },
    getPlacetoPay: async (id) => {
        await csrf.getCookie();
        return http.get(`/api/orders/${id}/placeto-pay`);
    },
    getAdminOrders: async () => {
        await csrf.getCookie()
        return http.get('/api/admin/orders');
    },
};

export default orders;
