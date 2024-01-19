import React, { useState, useEffect } from 'react';
import { Box, Button, Checkbox, TextField, List, ListItem, Typography } from '@mui/material';
import listTeams from '@/services/listTeamsService';

const ChampionshipPage = () => {
	const [teams, setTeams] = useState([]);
	const [selectedTeams, setSelectedTeams] = useState([]);
	const [searchQuery, setSearchQuery] = useState('');

	useEffect(() => {
		const fetchTeams = async () => {
			const teams = await listTeams();
			setTeams(teams);
		};
		fetchTeams();
	}, []);

	const handleSelectTeam = (team) => {
		if (selectedTeams.includes(team)) {
			setSelectedTeams(selectedTeams.filter((t) => t !== team));
		} else if (selectedTeams.length < 8) {
			setSelectedTeams([...selectedTeams, team]);
		}
	};

	const handleSearchChange = (event) => {
		setSearchQuery(event.target.value);
	};

	const filteredTeams = searchQuery
		? teams.filter((team) =>
			team.nome.toLowerCase().includes(searchQuery.toLowerCase())
		)
		: teams;

	const handleSimulate = () => {		
		console.log('Simulating championship with teams:', selectedTeams);
	};

	return (
		<Box sx={{ p: 3 }}>
			<Typography variant="h4" gutterBottom>
				Championship Simulation
			</Typography>
			<TextField
				label="Search Teams"
				variant="outlined"
				fullWidth
				value={searchQuery}
				onChange={handleSearchChange}
				sx={{ mb: 2 }}
			/>
			<List>
				{filteredTeams.map((team) => (
					<ListItem key={team.id} button onClick={() => handleSelectTeam(team)}>
						<Checkbox checked={selectedTeams.includes(team)} />
						<Typography>{team.nome}</Typography>
					</ListItem>
				))}
			</List>
			<Button
				variant="contained"
				color="primary"
				onClick={handleSimulate}
				disabled={selectedTeams.length !== 8}
				sx={{ mt: 2 }}
			>
				Simulate Championship
			</Button>
		</Box>
	);
};

export default ChampionshipPage;
