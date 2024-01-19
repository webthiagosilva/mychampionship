import React from 'react';
import { ThemeProvider } from '@mui/material/styles';
import theme from '@/theme';
import Routes from "@/routes/Routes";
import AuthContextProvider from "@/contexts/AuthContext";

const App = () => {
	return (
		<ThemeProvider theme={theme}>
			<AuthContextProvider>
				<Routes />
			</AuthContextProvider>
		</ThemeProvider>
	);
};

export default App;
