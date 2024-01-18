import React, { useState } from "react";
import LoginForm from "@/components/molecules/LoginForm/LoginForm";
import RegisterForm from "@/components/molecules/RegisterForm/RegisterForm";

const AuthForm = () => {
	const [isRegister, setIsRegister] = useState(false);

	const handleSwitch = () => {
		setIsRegister(!isRegister);
	};

	return (
		<div className="px-8 pt-6 pb-8 mb-4">
			{isRegister ? <RegisterForm /> : <LoginForm />}
			<div className="flex items-center justify-between">
				<button className="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" onClick={handleSwitch}>
					{isRegister ? 'Already have an account? Sign In' : 'Create an account'}
				</button>
			</div>
		</div>
	);
};

export default AuthForm;
