import React from "react";
import { Navigate } from "react-router-dom";
import useAuth from "@/hooks/useAuth";

const RedirectAuthenticated = ({ children }) => {
	const { isAuthenticated } = useAuth();

	if (isAuthenticated) {
		return <Navigate to="/admin/championship" replace />;
	}

	return children;
}

export default RedirectAuthenticated;
