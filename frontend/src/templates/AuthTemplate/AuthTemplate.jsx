import React from 'react';
import Header from '@/components/organisms/Header/Header';
import Footer from '@/components/organisms/Footer/Footer';
import Container from '@mui/material/Container';

const AuthTemplate = ({ children }) => {
	return (
		<div style={{ display: 'flex', flexDirection: 'column', minHeight: '100vh' }}>
			<Header />
			<Container maxWidth="lg" sx={{ flexGrow: 1, py: 2 }}>
				{children}
			</Container>
			<Footer />
		</div>
	);
};

export default AuthTemplate;
