import axios from "axios";

let http = axios.create({
  baseURL: window.location.origin,
  headers: {
    "Content-type": "application/json",
  },
});

http.defaults.withCredentials = true;

export default http;
