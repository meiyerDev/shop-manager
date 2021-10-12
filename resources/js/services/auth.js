import csrf from "./csrf";
import http from "./http";

const auth = {
    login: async (fields) => {
        await csrf.getCookie()
        return http.post('/api/login', fields);
    }
};

export default auth;
