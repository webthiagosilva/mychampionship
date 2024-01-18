import React from 'react';
import Header from '@/components/organisms/Header/Header';
import Footer from '@/components/organisms/Footer/Footer';

const AuthTemplate = ({ children }) => {
	return (
		<div className="flex flex-col min-h-screen bg-gray-100">
			<Header />
			<main className="flex-grow container mx-auto px-4 sm:px-6 lg:px-8 py-10">
				<div className="max-w-7xl mx-auto overflow-hidden">
					{children}
				</div>
			</main>
			<Footer />
		</div>
	);
};

export default AuthTemplate;
