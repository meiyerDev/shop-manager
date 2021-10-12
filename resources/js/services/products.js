import csrf from "./csrf";
import http from "./http";

const products = {
    fetchProducts: async () => {
        await csrf.getCookie()
        return http.get('/api/products');
    }
};

export default products;
