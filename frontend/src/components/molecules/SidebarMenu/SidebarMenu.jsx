import React from 'react';
import SidebarLink from '@/components/atoms/SidebarLink/SidebarLink';
import HomeIcon from '@mui/icons-material/Home';
import HistoryIcon from '@mui/icons-material/History';

const SidebarMenu = () => {
	return (
		<div>
			<SidebarLink to="/admin/championship" icon={<HomeIcon />}>Campeonato</SidebarLink>
			<SidebarLink to="/admin/historic" icon={<HistoryIcon />}>Histórico</SidebarLink>
		</div>
	);
};

export default SidebarMenu;
