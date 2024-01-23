import React, { useState, useEffect } from 'react';
import { Box, Button, TextField, Typography, Collapse, Paper, Divider, Snackbar, Alert } from '@mui/material';
import listTeams from '@/services/listTeamsService';
import TeamList from '@/components/organisms/TeamList/TeamList';
import ChampionshipBracket from '@/components/organisms/ChampionshipBracket/ChampionshipBracket';
import simulateChampionship from '@/services/simulateChampionshipService';

const ChampionshipPage = () => {
	const [teams, setTeams] = useState([]);
	const [selectedTeams, setSelectedTeams] = useState([]);
	const [searchQuery, setSearchQuery] = useState('');
	const [results, setResults] = useState(null);
	const [isListExpanded, setIsListExpanded] = useState(false);
	const [error, setError] = useState('');
	const [showError, setShowError] = useState(false);

	useEffect(() => {
		const fetchTeams = async () => {
			const teams = await listTeams();
			setTeams(teams);
		};
		fetchTeams();
	}, []);

	const handleSearchChange = (event) => {
		setSearchQuery(event.target.value);
	};

	const filteredTeams = searchQuery
		? teams.filter((team) =>
			team.nome.toLowerCase().includes(searchQuery.toLowerCase())
		)
		: teams;

	const handleSelectTeam = (team) => {
		if (selectedTeams.includes(team)) {
			setSelectedTeams(selectedTeams.filter((t) => t !== team));
		} else if (selectedTeams.length < 8) {
			setSelectedTeams([...selectedTeams, team]);
		}
	};

	const handleSimulate = async () => {
		const results = await simulateChampionship(selectedTeams, setError, setShowError);
		setResults(results);
		setIsListExpanded(false);
		setSelectedTeams([]);
	};

	const handleFocus = () => {
		setIsListExpanded(true);
	};

	return (
		<Box sx={{ p: 3 }}>
			{showError && (
				<Alert severity="error" sx={{ mb: 2 }}>
					{error}
				</Alert>
			)}

			<Typography variant="h5" gutterBottom>
				Selecione os 8 times que participarão do campeonato
			</Typography>

			<Box sx={{ display: 'flex', alignItems: 'center', mb: 2 }}>
				<TextField
					label="Search Teams"
					variant="outlined"
					fullWidth
					value={searchQuery}
					onChange={handleSearchChange}
					onFocus={handleFocus}
					sx={{ mr: 4 }}
				/>
				<Button
					variant="contained"
					color="primary"
					onClick={handleSimulate}
					disabled={selectedTeams.length !== 8 || !isListExpanded}

				>
					Simular Campeonato
				</Button>
			</Box>

			<Collapse in={isListExpanded}>
				<Paper sx={{ mb: 2, maxHeight: 300, overflow: 'auto' }}>
					<TeamList
						teams={filteredTeams}
						selectedTeams={selectedTeams}
						onSelectTeam={handleSelectTeam}
					/>
				</Paper>
			</Collapse>

			<Divider sx={{ my: 6 }} />

			<Box sx={{ my: 10 }}>
				{results && <ChampionshipBracket championshipData={results} />}
			</Box>
		</Box>
	);
};

export default ChampionshipPage;
