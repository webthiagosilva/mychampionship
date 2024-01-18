import React, { useState, useEffect } from "react";

export const AuthContext = React.createContext();

const initialAuthState = {
	user: null,
	token: null,
	isAuthenticated: false
};

const AuthContextProvider = ({ children }) => {
	const [authState, setAuthState] = useState(() => {
		const storedAuthState = sessionStorage.getItem('authState');
		return storedAuthState ? JSON.parse(storedAuthState) : initialAuthState;
	});

	useEffect(() => {
		sessionStorage.setItem('authState', JSON.stringify(authState));
	}, [authState]);

	return (
		<AuthContext.Provider value={{ authState, setAuthState }}>
			{children}
		</AuthContext.Provider>
	);
}

export default AuthContextProvider;
