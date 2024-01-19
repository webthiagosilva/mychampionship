import React from 'react';
import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography';

const Footer = () => {
	return (
		<Box sx={{ bgcolor: 'primary.dark', p: 2, mt: 2, textAlign: 'center', color: 'white' }}>
			<Typography variant="body2">
				© {new Date().getFullYear()} My Championship. All rights reserved.
			</Typography>
		</Box>
	);
};

export default Footer;
