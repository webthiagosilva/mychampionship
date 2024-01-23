import React from 'react';
import { Grid } from '@mui/material';
import ChampionshipHistoryCard from '@/components/molecules/ChampionshipHistoryCard/ChampionshipHistoryCard';

const HistoricChampionshipList = ({ championships }) => {
	return (
		<Grid container spacing={2}>
			{championships.map((championship, index) => (
				<Grid item xs={12} md={6} lg={4} key={index}>
					<ChampionshipHistoryCard championship={championship} />
				</Grid>
			))}
		</Grid>
	);
};

export default HistoricChampionshipList;

