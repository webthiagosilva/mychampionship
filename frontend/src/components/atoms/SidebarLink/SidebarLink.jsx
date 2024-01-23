import React from 'react';
import { NavLink, useLocation } from 'react-router-dom';
import ListItem from '@mui/material/ListItem';
import ListItemIcon from '@mui/material/ListItemIcon';
import ListItemText from '@mui/material/ListItemText';

const SidebarLink = ({ to, icon, children }) => {
	const location = useLocation();
	const isActive = location.pathname === to;

	return (
		<ListItem button component={NavLink} to={to} selected={isActive}>
			{icon && <ListItemIcon>{icon}</ListItemIcon>}
			<ListItemText primary={children} />
		</ListItem>
	);
};

export default SidebarLink;
