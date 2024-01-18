import React from 'react';
import Sidebar from '@/components/organisms/Sidebar/Sidebar';
import Header from '@/components/organisms/Header/Header';

const AdminTemplate = ({ children }) => {
	return (
		<div className="flex h-screen bg-gray-100">
			<Sidebar />
			<div className="flex flex-col w-full">
				<Header />
				<main className="flex-grow p-4">
					{children}
				</main>
			</div>
		</div>
	);
};

export default AdminTemplate;
