import { Axios } from "axios";

const axios = new Axios({
    baseURL: import.meta.env.VITE_API_URL,
    headers: {
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content"),
    },
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
