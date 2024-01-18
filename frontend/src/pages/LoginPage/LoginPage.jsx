import React from "react";
import AuthTemplate from "@/templates/AuthTemplate/AuthTemplate";
import LoginForm from "@/components/molecules/LoginForm/LoginForm";
import TextLink from "@/components/atoms/TextLink/TextLink";
import Logo from "@/assets/icons/logo.svg";

const LoginPage = () => {
  return (
    <AuthTemplate>
      <div className="flex flex-col items-center justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8 -mt-20">
        <div className="w-full max-w-lg space-y-8">
          <div>
            <img className="mx-auto h-12 w-auto" src={Logo} alt="My Championship" />
            <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
              Acesse sua conta
            </h2>
          </div>

          <LoginForm />

          <div className="mt-4 text-center">
            <TextLink to="/register" className="font-medium text-blue-600 hover:text-blue-500">
              Não tem uma conta? Crie uma
            </TextLink>
          </div>
        </div>
      </div>
    </AuthTemplate>
  );
};

export default LoginPage;
