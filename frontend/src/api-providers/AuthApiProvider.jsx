import axios from "@/utils/axios";

export const postToken = async (email, password) => {
	const response = await axios.post("auth/token", { email, password });
	return response.data;
}

export const postRegister = async (name, email, password, password_confirmation) => {
	const response = await axios.post("auth/register", { name, email, password, password_confirmation });	
	return response.data;
}

export const deleteToken = async () => {
	const response = await axios.delete("auth/token");
	return response.data;
}
