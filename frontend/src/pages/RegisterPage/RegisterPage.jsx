import React from 'react';
import RegisterForm from '@/components/molecules/RegisterForm/RegisterForm';
import AuthTemplate from '@/templates/AuthTemplate/AuthTemplate';
import Typography from '@mui/material/Typography';
import Container from '@mui/material/Container';
import Paper from '@mui/material/Paper';
import Logo from '@/assets/icons/logo.svg';
import { Link } from 'react-router-dom';

const RegisterPage = () => {
    return (
        <AuthTemplate>
            <Container component="main" maxWidth="xs">
                <Paper elevation={3} sx={{ p: 4, mt: 8, display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                    <img src={Logo} alt="My Championship" style={{ height: '48px' }} />
                    <Typography component="h1" variant="h5" sx={{ mt: 2, mb: 2 }}>
                        Crie uma conta
                    </Typography>
                    <RegisterForm />
                    <Typography mt={2} textAlign="center">
                        <Link to="/login" style={{ color: '#1976d2' }}>
                            Já tem uma conta? Entre aqui
                        </Link>
                    </Typography>
                </Paper>
            </Container>
        </AuthTemplate>
    );
};

export default RegisterPage;
