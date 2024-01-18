import axios from "axios";
import baseUrl from "@/api-providers/baseUrl";

const axiosInstance = axios.create({ baseURL: baseUrl });

axiosInstance.interceptors.request.use(
	config => {
		const authState = sessionStorage.getItem('authState');
		const token = authState && JSON.parse(authState).token;

		if (token) {
			config.headers.Authorization = `Bearer ${token}`;
		}

		return config;
	},
	error => Promise.reject(error)
);

export default axiosInstance;
