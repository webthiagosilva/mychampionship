import React from 'react';
import logo from '@/assets/icons/logo.svg';
import SidebarMenu from '@/components/molecules/SidebarMenu/SidebarMenu';
import SidebarButton from '@/components/atoms/SidebarButton/SidebarButton';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faSignOutAlt } from '@fortawesome/free-solid-svg-icons';
import useAuth from '@/hooks/useAuth';
import logout from '@/services/logoutService';
import { useNavigate } from 'react-router-dom';


const Sidebar = () => {
	const { setAuthState } = useAuth();
	const navigate = useNavigate();

	const handleLogout = async () => {
		await logout(setAuthState);
		navigate('/');
	};

	return (
		<aside className="w-80 bg-gray-800 text-white flex flex-col">
			<div className="flex items-center justify-center h-20">
				<img src={logo} alt="Logo" className="h-12" />
			</div>

			<hr className="border-t border-gray-600 -my-1" />

			<SidebarMenu />

			<div className="flex-grow"></div>

			<div className='flex flex-col p-4'>
				<SidebarButton
					icon={<FontAwesomeIcon icon={faSignOutAlt} />}
					onClick={handleLogout}
				>Sair
				</SidebarButton>
			</div>
		</aside>
	);
};

export default Sidebar;
