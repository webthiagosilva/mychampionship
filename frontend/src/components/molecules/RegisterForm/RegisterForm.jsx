import React, { useState } from 'react';
import { TextField, Button, Box } from '@mui/material';
import register from '@/services/registerService';
import { useNavigate } from 'react-router-dom';

const RegisterForm = () => {
	const [name, setName] = useState('');
	const [email, setEmail] = useState('');
	const [password, setPassword] = useState('');
	const [passwordConfirmation, setPasswordConfirmation] = useState('');
	const navigate = useNavigate();

	const handleSubmit = async (event) => {
		event.preventDefault();
		const success = await register(name, email, password, passwordConfirmation);
		if (success) {
			navigate('/login');
		} else {
			window.alert('Erro ao cadastrar usuário, tente novamente.');
		}
	};

	const isFormValid = () => {
		return name && email && password && password.length >= 6 && password === passwordConfirmation;
	};

	return (
		<Box component="form" onSubmit={handleSubmit} sx={{ mt: 1 }}>
			<TextField
				margin="normal"
				required
				fullWidth
				label="Nome"
				type="text"
				value={name}
				onChange={e => setName(e.target.value)}
			/>
			<TextField
				margin="normal"
				required
				fullWidth
				label="Email"
				type="email"
				value={email}
				onChange={e => setEmail(e.target.value)}
			/>
			<TextField
				margin="normal"
				required
				fullWidth
				label="Senha"
				type="password"
				value={password}
				onChange={e => setPassword(e.target.value)}
			/>
			<TextField
				margin="normal"
				required
				fullWidth
				label="Confirmação de senha"
				type="password"
				value={passwordConfirmation}
				onChange={e => setPasswordConfirmation(e.target.value)}
			/>
			<Button
				type="submit"
				fullWidth
				variant="contained"
				sx={{ mt: 3, mb: 2 }}
				disabled={!isFormValid()}
			>
				Cadastrar
			</Button>
		</Box>
	);
};

export default RegisterForm;
