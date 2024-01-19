import React from 'react';
import { Outlet } from 'react-router-dom';
import AdminTemplate from '@/templates/AdminTemplate/AdminTemplate';
import Paper from '@mui/material/Paper';

const AdminPage = () => {
    return (
        <AdminTemplate>
            <Paper sx={{ p: 3, margin: 'auto', maxWidth: '100-vh', flexGrow: 1 }}>
                <Outlet />
            </Paper>
        </AdminTemplate>
    );
};

export default AdminPage;
