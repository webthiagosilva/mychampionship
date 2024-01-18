import React from 'react';
import { Link } from 'react-router-dom';

const TextLink = ({ to, children, className }) => {
	return (
		<Link to={to} className={`inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800 ${className}`}>
			{children}
		</Link>
	);
};

export default TextLink;
