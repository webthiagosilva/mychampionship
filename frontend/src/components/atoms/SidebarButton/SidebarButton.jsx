import React from 'react';
import { ListItem, ListItemIcon, ListItemText, Button } from '@mui/material';
import ExitToAppIcon from '@mui/icons-material/ExitToApp';

const SidebarButton = ({ onClick, text }) => {
	return (
		<ListItem>
			<Button onClick={onClick} fullWidth startIcon={<ExitToAppIcon />}>
				<ListItemText primary={text} />
			</Button>
		</ListItem>
	);
};

export default SidebarButton;
