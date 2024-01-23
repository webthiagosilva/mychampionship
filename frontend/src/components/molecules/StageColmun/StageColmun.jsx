import React from "react";
import { Box, Typography } from "@mui/material";
import GameCard from "@/components/molecules/GameCard/GameCard";

const StageColmun = ({ phaseGames, phaseName }) => (
	<Box sx={{ width: '25%' }}>
		<Typography variant="h6" align="center" sx={{ mb: 2 }}>
			{phaseName}
		</Typography>
		{phaseGames.map((game) => (
			<GameCard key={game.id} game={game} />
		))}
	</Box>
);

export default StageColmun;
