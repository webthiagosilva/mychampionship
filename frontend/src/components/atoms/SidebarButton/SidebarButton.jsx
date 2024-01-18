import React from 'react';

const SidebarButton = ({ onClick, icon, children }) => {
	return (
		<button
			onClick={onClick}
			className="flex items-center py-2 px-3 rounded mb-2 text-lg text-white hover:bg-blue-700 w-full text-center"
		>
			{icon && <span className="mr-2">{icon}</span>}
			{children}
		</button>
	);
};

export default SidebarButton;
