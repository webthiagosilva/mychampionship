import React from "react";
import Routes from "@/routes/Routes";
import AuthContextProvider from "@/contexts/AuthContext";

const App = () => {
	return (
		<AuthContextProvider>
			<Routes />
		</AuthContextProvider>
	);
};

export default App;
