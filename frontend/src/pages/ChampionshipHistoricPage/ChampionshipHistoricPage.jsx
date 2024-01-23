import React, { useState, useEffect } from 'react';
import { Box, Button, TextField, Typography, Collapse, Paper, Divider, Snackbar, Alert, Pagination } from '@mui/material';
import HistoricChampionshipList from '@/components/organisms/HistoricChampionshipList/HistoricChampionshipList';
import listChampionships from '@/services/listChampionshipsService';


const ChampionshipHistoricPage = () => {

	const [error, setError] = useState('');
	const [showError, setShowError] = useState(false);

	const [championships, setChampionships] = useState([]);
	const [page, setPage] = useState(1);
	const [totalPages, setTotalPages] = useState(1);

	useEffect(() => {
		const fetchChampionships = async () => {
			const championships = await listChampionships(page, showError, setError);
			console.log(championships);
			setChampionships(championships.data);
			setTotalPages(championships.total);
		};
		fetchChampionships();
	}, [page]);

	const handlePageChange = (event, value) => {
		setPage(value);
	}

	return (
		<Box sx={{ p: 3 }}>
			{showError && (
				<Alert severity="error" sx={{ mb: 2 }}>
					{error}
				</Alert>
			)}
			<Typography variant="h5" gutterBottom>
				Histórico de Campeonatos
			</Typography>

			<HistoricChampionshipList championships={championships} />
			<Divider sx={{ mb: 2 }} />
			<Pagination count={totalPages} page={page} onChange={handlePageChange} />

		</Box>
	);
};

export default ChampionshipHistoricPage;
