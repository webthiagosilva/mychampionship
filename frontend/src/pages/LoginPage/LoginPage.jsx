import React from 'react';
import AuthTemplate from '@/templates/AuthTemplate/AuthTemplate';
import LoginForm from '@/components/molecules/LoginForm/LoginForm';
import Box from '@mui/material/Box';
import Typography from '@mui/material/Typography';
import Container from '@mui/material/Container';
import Paper from '@mui/material/Paper';
import Logo from '@/assets/icons/logo.svg';
import { Link } from 'react-router-dom';

const LoginPage = () => {
    return (
        <AuthTemplate>
            <Container component="main" maxWidth="xs">
                <Paper elevation={3} sx={{ p: 4, mt: 8, display: 'flex', flexDirection: 'column', alignItems: 'center' }}>
                    <img src={Logo} alt="My Championship" style={{ height: '48px' }} />
                    <Typography component="h1" variant="h5" sx={{ mt: 2, mb: 2 }}>
                        Acesse sua conta
                    </Typography>
                    <LoginForm />
                    <Box mt={2} textAlign="center">
                        <Link to="/register" style={{ color: '#1976d2' }}>
                            Não tem uma conta? Crie uma
                        </Link>
                    </Box>
                </Paper>
            </Container>
        </AuthTemplate>
    );
};

export default LoginPage;
