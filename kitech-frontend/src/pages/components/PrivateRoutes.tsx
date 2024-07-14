import React from 'react'
import { Navigate, Outlet } from 'react-router-dom'
import Header from './Header'
import Footer from './Footer'

const PrivateRoutes = () => {
    return (
        <>
            {
                localStorage.getItem("userData") ? <>
                    <Header />
                    <Outlet />
                    <Footer />
                </> : <Navigate to={'/login'} />
            }
        </>
    )
}

export default PrivateRoutes