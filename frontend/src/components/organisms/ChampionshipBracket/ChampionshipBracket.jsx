import React from 'react';
import { Box, Grid } from '@mui/material';
import StageColmun from '@/components/molecules/StageColmun/StageColmun';

const ChampionshipBracket = ({ championshipData }) => {
	const stageNames = {
		quartas: "Quartas",
		semifinais: "Semifinais",
		terceiro_lugar: "3º Lugar",
		final: "Final"
	};

	return (
		<Box sx={{ display: 'flex', justifyContent: 'space-between' }}>
			<Grid container spacing={2} justifyContent="center">
				{Object.entries(stageNames).map(([phaseKey, phase]) => (
					<StageColmun
						key={phaseKey}
						phaseName={phase}
						phaseGames={championshipData.jogos[phaseKey]}
					/>
				))}
			</Grid>
		</Box >
	);
};

export default ChampionshipBracket;
