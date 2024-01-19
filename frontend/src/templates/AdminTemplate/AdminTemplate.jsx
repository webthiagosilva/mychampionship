import React from 'react';
import Sidebar from '@/components/organisms/Sidebar/Sidebar';
import Header from '@/components/organisms/Header/Header';
import { Box } from '@mui/material';

const AdminTemplate = ({ children }) => {
	return (
		<Box sx={{ display: 'flex', height: '100vh', bgcolor: 'background.default' }}>
			<Sidebar />
			<Box sx={{ flexGrow: 1, display: 'flex', flexDirection: 'column' }}>
				<Header />
				<Box component="main" sx={{ flexGrow: 1, p: 3 }}>
					{children}
				</Box>
			</Box>
		</Box>
	);
};

export default AdminTemplate;
