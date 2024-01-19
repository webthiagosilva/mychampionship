import { createTheme } from '@mui/material/styles';

const theme = createTheme({
	palette: {
		primary: {
			main: '#4CAF50',
			contrastText: '#fff',
		},
		secondary: {
			main: '#000000',
			contrastText: '#fff',
		},
		error: {
			main: '#f44336',
		},
		background: {
			default: '#f4f4f4',
			paper: '#fff',
		},
	},
	typography: {
		h1: {
			fontSize: '2.5rem',
			fontWeight: 500,
		},
		h2: {
			fontSize: '2rem',
			fontWeight: 500,
		},
	},
});

export default theme;
