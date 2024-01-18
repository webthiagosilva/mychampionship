import { deleteToken } from "@/api-providers/AuthApiProvider";

const logout = async (setAuthState) => {
	try {
		await deleteToken();

		setAuthState({
			user: null,
			token: null,
			isAuthenticated: false
		});
	} catch (error) {
		console.error(error);
	}
}

export default logout;
