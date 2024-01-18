import { useContext } from "react";
import { AuthContext } from "@/contexts/AuthContext";

const useAuth = () => {
	const context = useContext(AuthContext);

	if (!context) {
		throw new Error('useAuth must be used within an AuthProvider');
	}

	const { authState, setAuthState } = context;

	return { ...authState, setAuthState };
};

export default useAuth;
