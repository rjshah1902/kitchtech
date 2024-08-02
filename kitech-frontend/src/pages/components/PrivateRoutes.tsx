import React from 'react'
import { Navigate, Outlet } from 'react-router-dom'
import { useSelector } from 'react-redux'
import Header from './Header'
import Footer from './Footer'

const PrivateRoutes = () => {

    const { user } = useSelector((state: any) => state.user);

    const isAuthenticated = !!user;

    return isAuthenticated ? (
        <>
            <Header />
            <Outlet />
            <Footer />
        </>
    ) : (
        <Navigate to="/login" />
    );
}

export default PrivateRoutes
