import axios from "axios";

const axiosInstance = axios.create({
    baseURL: 'http://127.0.0.1:8876',
    timeout: 3000,

});

// axiosInstance.interceptors.request.

export default axiosInstance;