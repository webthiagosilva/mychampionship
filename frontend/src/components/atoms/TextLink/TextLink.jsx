import React from 'react';
import { Link } from 'react-router-dom';

const TextLink = ({ to, children }) => {
	return (
		<Link to={to} style={{ color: '#1976d2', textDecoration: 'none', fontWeight: 'bold' }}>
			{children}
		</Link>
	);
};

export default TextLink;
