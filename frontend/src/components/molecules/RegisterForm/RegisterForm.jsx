import React, { useState } from "react";
import Input from "@/components/atoms/Input/Input";
import Button from "@/components/atoms/Button/Button";
import register from "@/services/registerService";
import { useNavigate } from "react-router-dom";

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
		return name
			&& email
			&& password
			&& password.length >= 6
			&& password === passwordConfirmation;
	}

	return (
		<form onSubmit={handleSubmit} className="space-y-6">
			<Input
				label="Nome"
				type="text"
				placeholder="João da Silva"
				value={name}
				onChange={e => setName(e.target.value)}
			/>
			<Input
				label="Email"
				type="email"
				placeholder="joaodasilva@hotmail.com"
				value={email}
				onChange={e => setEmail(e.target.value)}
			/>
			<Input
				label="Senha"
				type="password"
				placeholder="Uma senha segura"
				value={password}
				onChange={e => setPassword(e.target.value)}
			/>
			<Input
				label="Confirmação de senha"
				type="password"
				placeholder="Confirme sua senha"
				value={passwordConfirmation}
				onChange={e => setPasswordConfirmation(e.target.value)}
			/>
			<Button
				type="submit"
				text="Cadastrar"
				disabled={!isFormValid()}
			/>
		</form>
	);
};

export default RegisterForm;
