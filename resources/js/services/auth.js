import csrf from "./csrf";
import http from "./http";

const auth = {
    login: async (fields) => {
        await csrf.getCookie()
        return http.post('/api/login', fields);
    },
    getAuth: async () => {
        await csrf.getCookie()
        return http.get('/api/user');
    },
    logout: async () => {
        await csrf.getCookie()
        return http.post('/api/logout');
    },
};

export default auth;
