import React from 'react';
import logo from '@/assets/icons/logo.svg';
import SidebarMenu from '@/components/molecules/SidebarMenu/SidebarMenu';
import SidebarButton from '@/components/atoms/SidebarButton/SidebarButton';
import useAuth from '@/hooks/useAuth';
import logout from '@/services/logoutService';
import { useNavigate } from 'react-router-dom';
import { Box, Divider, Drawer } from '@mui/material';

const Sidebar = () => {
	const { setAuthState } = useAuth();
	const navigate = useNavigate();

	const handleLogout = async () => {
		await logout(setAuthState);
		navigate('/');
	};

	return (
		<Drawer variant="permanent" sx={{ width: 240, '& .MuiDrawer-paper': { width: 240, boxSizing: 'border-box' } }}>
			<Box sx={{ display: 'flex', flexDirection: 'column', height: '100%' }}>
				<Box sx={{ p: 2, display: 'flex', justifyContent: 'center' }}>
					<img src={logo} alt="Logo" style={{ height: '48px' }} />
				</Box>
				<Divider />
				<SidebarMenu />
				<Box sx={{ flexGrow: 1 }} />
				<Divider />
				<Box sx={{ p: 2 }}>
					<SidebarButton onClick={handleLogout} text="Sair" />
				</Box>
			</Box>
		</Drawer>
	);
};

export default Sidebar;
