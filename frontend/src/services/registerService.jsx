import { postRegister } from "@/api-providers/AuthApiProvider";

const register = async (name, email, password, passwordConfirmation) => {
	try {
		const response = await postRegister(name, email, password, passwordConfirmation);
		return response.status === 'success';
	} catch (error) {
		return false;
	}
}

export default register;
