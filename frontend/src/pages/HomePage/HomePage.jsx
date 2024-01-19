import React from 'react';
import Button from '@mui/material/Button';
import Typography from '@mui/material/Typography';
import AuthTemplate from '@/templates/AuthTemplate/AuthTemplate';
import { Link } from 'react-router-dom';

const HomePage = () => {
    return (
        <AuthTemplate>
            <div style={{ display: 'flex', flexDirection: 'column', alignItems: 'center', justifyContent: 'center', height: '100vh' }}>
                <Typography variant="h4" component="h2" gutterBottom>
                    Gerencie seus Campeonatos
                </Typography>
                <Typography variant="subtitle1" gutterBottom>
                    Participe e acompanhe seus campeonatos locais de forma simples e eficaz.
                </Typography>
                <Button variant="contained" color="primary" component={Link} to="/login">
                    Acesse Agora
                </Button>
            </div>
        </AuthTemplate>
    );
};

export default HomePage;
