import { Axios } from "axios";

const axios = new Axios({
    baseURL: import.meta.env.VITE_API_URL,
    headers: {
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content"),
        "Content-Type": "application/json",
    },
    transformRequest: [
        (data, headers) => {
            const token = sessionStorage.getItem("token");
            if (token) {
                headers["Authorization"] = `Bearer ${token}`;
            }

            if (data instanceof FormData) {
                headers["Content-Type"] = "multipart/form-data";
                return data;
            } else if (data instanceof Object) {
                headers["Content-Type"] = "application/json";
                return JSON.stringify(data);
            }
            return data;
        },
    ],
    transformResponse: [
        (data) => {
            try {
                return JSON.parse(data);
            } catch (error) {
                return data;
            }
        },
    ],
});

export default axios;
