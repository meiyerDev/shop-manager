import http from "./http";

const getCookie = () => {
  return http.get("/api/csrf-cookie");
};

const csrf = {
  getCookie,
};

export default csrf;
