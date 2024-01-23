import React from 'react';
import { Box } from '@mui/material';
import TeamCard from '@/components/molecules/TeamCard/TeamCard';


const GameCard = ({ game }) => (
	<Box
		sx={{
			border: '1px solid',
			borderColor: 'divider',
			borderRadius: '4px',
			overflow: 'hidden',
			mb: '10px',
			mr: '10px',
		}}
	>
		<TeamCard
			teamName={game.nome_time_casa}
			score={game.placar_casa}
			isWinner={game.time_vencedor_id === game.time_casa_id}
		/>
		<TeamCard
			teamName={game.nome_time_visitante}
			score={game.placar_visitante}
			isWinner={game.time_vencedor_id === game.time_visitante_id}
		/>
	</Box>
);

export default GameCard;
