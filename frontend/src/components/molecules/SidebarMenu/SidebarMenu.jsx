import React from 'react';
import SidebarLink from '@/components/atoms/SidebarLink/SidebarLink';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { faHome, faDatabase } from '@fortawesome/free-solid-svg-icons';

const SidebarMenu = () => {
	return (
		<nav className="flex flex-col p-4">
			<SidebarLink to="/admin/dashboard" icon={<FontAwesomeIcon icon={faHome} />}>
				Campeonato
			</SidebarLink>
			<SidebarLink to="/admin/historic" icon={<FontAwesomeIcon icon={faDatabase} />}>
				Histórico
			</SidebarLink>
		</nav>
	);
};

export default SidebarMenu;
