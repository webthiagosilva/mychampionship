
import React from 'react';
import { ListItem, Checkbox, Typography } from '@mui/material';

const TeamListItem = ({ team, isSelected, onSelect }) => (
	<ListItem button onClick={() => onSelect(team)}>
		<Checkbox checked={isSelected} />
		<Typography>{team.nome}</Typography>
	</ListItem>
);

export default TeamListItem;
