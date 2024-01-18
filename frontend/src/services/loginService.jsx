import { postToken } from "@/api-providers/AuthApiProvider";

const login = async (email, password, setAuthState) => {
	try {
		const response = await postToken(email, password);

		setAuthState({
			user: response.data.user,
			token: response.data.access_token,
			isAuthenticated: true
		});

		return true;
	} catch (error) {		
		return false;
	}
}

export default login;
