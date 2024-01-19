import React, { useState } from 'react';
import { TextField, Button, Box } from '@mui/material';
import useAuth from '@/hooks/useAuth';
import login from '@/services/loginService';
import { useNavigate } from 'react-router-dom';

const LoginForm = () => {
	const [email, setEmail] = useState('');
	const [password, setPassword] = useState('');
	const { setAuthState } = useAuth();
	const navigate = useNavigate();

	const handleSubmit = async (event) => {
		event.preventDefault();
		const result = await login(email, password, setAuthState);
		if (result) {
			navigate('/admin');
		} else {
			window.alert('Erro ao fazer login, tente novamente.');
		}
	};

	return (
		<Box component="form" onSubmit={handleSubmit} sx={{ mt: 1 }}>
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
				label="Password"
				type="password"
				value={password}
				onChange={e => setPassword(e.target.value)}
			/>
			<Button
				type="submit"
				fullWidth
				variant="contained"
				sx={{ mt: 3, mb: 2 }}
				disabled={!email || !password}
			>
				Entrar
			</Button>
		</Box>
	);
};

export default LoginForm;
