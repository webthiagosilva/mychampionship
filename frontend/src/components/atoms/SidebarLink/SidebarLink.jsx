import React from 'react';
import { NavLink, useLocation } from 'react-router-dom';

const SidebarLink = ({ to, icon, children }) => {
	const location = useLocation();
	const isActive = location.pathname.includes(to);

	return (
		<NavLink
			to={to}
			className={`flex items-center py-2 px-3 rounded mb-2 text-lg text-white ${
				isActive ? 'bg-blue-700' : 'hover:bg-blue-700'
				}`}
		>
			{icon && <span className="mr-2">{icon}</span>}
			{children}
		</NavLink>
	);
};

export default SidebarLink;

