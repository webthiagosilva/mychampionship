import React from "react";
import { Card, CardContent, Typography, List, ListItem, Divider, useTheme, Box } from "@mui/material";
import { format } from "date-fns";
import SportsSoccerIcon from '@mui/icons-material/SportsSoccer';

const ChampionshipHistoryCard = ({ championship }) => {
	const theme = useTheme();

	const gamesByPhase = championship.jogos.reduce((acc, jogo) => {
		acc[jogo.fase] = acc[jogo.fase] || [];
		acc[jogo.fase].push(jogo);
		return acc;
	}, {});

	return (
		<Card sx={{ mb: 2, '&:hover': { boxShadow: 6 } }}>
			<CardContent>
				<Typography variant="h6" gutterBottom>
					<SportsSoccerIcon color="primary" /> Campeonato {championship.id}
				</Typography>
				<Typography variant="subtitle1" color="textSecondary">
					Time Vencedor: <span style={{ fontWeight: 'bold', color: theme.palette.primary.main }}>{championship.nome_time_vencedor}</span>
				</Typography>
				<Typography variant="body2" color="textSecondary">
					em: {format(new Date(championship.data_fim), 'dd/MM/yyyy HH:mm')}
				</Typography>
				<Divider sx={{ my: 1.5 }} />

				{Object.entries(gamesByPhase).map(([fase, games]) => (
					<Box key={fase}>
						<Typography variant="subtitle1" sx={{ mt: 2, mb: 1 }}>
							{fase.toUpperCase()}
						</Typography>
						<List dense>
							{games.map((jogo, index) => (
								<ListItem key={index}>
									<Typography variant="body2">
										{jogo.nome_time_casa}
										<strong> ({jogo.placar_casa}) </strong> vs
										<strong> ({jogo.placar_visitante}) </strong>
										{jogo.nome_time_visitante} <br />
										Vencedor: <span style={{ fontWeight: 'bold' }}>{jogo.nome_time_vencedor}</span>
									</Typography>
								</ListItem>
							))}
						</List>
					</Box>
				))}
			</CardContent>
		</Card>
	);
};

export default ChampionshipHistoryCard;
