import React, { useState } from "react";
import { redirect } from "react-router-dom";
import Input from "@/components/atoms/Input/Input";
import Button from "@/components/atoms/Button/Button";
import useAuth from "@/hooks/useAuth";
import login from "@/services/loginService";

const LoginForm = () => {
	const [email, setEmail] = useState('');
	const [password, setPassword] = useState('');
	const { setAuthState } = useAuth();

	const handleSubmit = async (event) => {
		event.preventDefault();

		const result = await login(email, password, setAuthState);

		if (result) {
			redirect('/admin/dashboard');
		} else {
			window.alert('Erro ao fazer login, tente novamente.');
		}
	};

	return (
		<form onSubmit={handleSubmit} className="space-y-6">
			<Input
				label="Email"
				type="email"
				placeholder="Email"
				value={email}
				onChange={e => setEmail(e.target.value)}
			/>
			<Input
				label="Senha"
				type="password"
				placeholder="Senha"
				value={password}
				onChange={e => setPassword(e.target.value)}
			/>
			<Button
				type="submit"
				text="Entrar"
				disabled={!email || !password}
			/>
		</form>
	);
};

export default LoginForm;
