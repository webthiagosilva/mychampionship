import React from 'react';

const Footer = () => {
	return (
		<footer className="bg-blue-950 text-center text-gray-100 p-4 mt-2">
			<p>© {new Date().getFullYear()} My Championship. All rights reserved.</p>
		</footer>
	);
};

export default Footer;
