import React from "react";
import RegisterForm from "@/components/molecules/RegisterForm/RegisterForm";
import AuthTemplate from "@/templates/AuthTemplate/AuthTemplate";
import TextLink from "@/components/atoms/TextLink/TextLink";
import Logo from "@/assets/icons/logo.svg";

const RegisterPage = () => {
  return (
    <AuthTemplate>
      <div className="flex flex-col items-center justify-center min-h-screen py-12 bg-gray-50 sm:px-6 lg:px-8 -mt-20">
        <div className="w-full max-w-md space-y-8">
          <div>
            <img className="mx-auto h-12 w-auto" src={Logo} alt="My Championship" />
            <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
              Crie uma conta
            </h2>
          </div>

          <RegisterForm />

          <div className="mt-4 text-center">
            <TextLink to="/login" className="font-medium text-blue-600 hover:text-blue-500">
              Já tem uma conta? Entre aqui
            </TextLink>
          </div>
        </div>
      </div>
    </AuthTemplate>
  );
};

export default RegisterPage;
