import React from "react";
import { Box, Typography } from "@mui/material";

const TeamCard = ({ teamName, score, isWinner }) => (
	<Box
		sx={{
			bgcolor: isWinner ? 'green' : '#d50000',
			color: 'white',
			p: 1,
			display: 'flex',
			justifyContent: 'space-between',
		}}
	>
		<Typography sx={{ fontWeight: 'bold' }}>{teamName}</Typography>
		<Typography sx={{ fontWeight: 'bold' }}>{score}</Typography>
	</Box>
);

export default TeamCard;
