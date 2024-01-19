import React from 'react';
import { RouterProvider, createBrowserRouter } from "react-router-dom";
import ProtectedRoute from "@/routes/ProtectedRoute";
import RedirectAuthenticated from "@/routes/RedirectAuthenticated";
import HomePage from "@/pages/HomePage/HomePage";
import LoginPage from '@/pages/LoginPage/LoginPage';
import RegisterPage from "@/pages/RegisterPage/RegisterPage";
import AdminPage from "@/pages/AdminPage/AdminPage";

const Routes = () => {
	const router = createBrowserRouter([
		{
			path: '/',
			element: <HomePage />,
		},
		{
			path: '/login',
			element: (
				<RedirectAuthenticated>
					<LoginPage />
				</RedirectAuthenticated>
			),
		},
		{
			path: '/register',
			element: (
				<RedirectAuthenticated>
					<RegisterPage />
				</RedirectAuthenticated>
			),
		},
		{
			path: '/admin',
			element: (
				<ProtectedRoute>
					<AdminPage />
				</ProtectedRoute>
			),
			children: [
				{
					path: 'championship',
					element: <h1>Admin</h1>,
				},
			],
		}
	]);

	return <RouterProvider router={router} />;
};

export default Routes;
