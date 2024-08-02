/* eslint-disable react-hooks/rules-of-hooks */
"use client";
import React, { useEffect, useState } from 'react'
import { useDispatch } from 'react-redux';
import { Link, useNavigate } from 'react-router-dom';
import { persistor } from '../../store';
import { logout } from '../../store/userSlice';

const Header: React.FC = () => {

    const dispatch = useDispatch();
    const navigate = useNavigate();

    const [useLogedIn, setUseLogedIn] = useState<boolean>(false);
    const [userName, setUserName] = useState<string>("");

    useEffect(() => {
        localStorage.getItem("userData") && setUseLogedIn(true);
        localStorage.getItem("userData") && getUserData();
    }, []);

    const getUserData = () => {

        let userData: any = localStorage.getItem("userData");
        let data = JSON.parse(userData);
        setUserName(data?.username);
    }

    const userLogout = () => {
        localStorage.removeItem("userData");
        dispatch(logout());
        persistor.purge();
        navigate('/login');
    }

    const menuItems = [
        {
            name: 'Home',
            href: '/',
        },
        {
            name: 'Food Items',
            href: '/food-items',
        },
        {
            name: 'Food Terminology',
            href: '/food-terminology',
        },
        {
            name: 'Home Residents',
            href: '/home-residents',
        },
    ]

    return (
        <>
            <div className="relative w-full bg-white shadow-md py-4">
                <div className="mx-auto flex max-w-7xl items-center justify-between px-4 py-2 sm:px-6 lg:px-8">
                    <div className="inline-flex items-center space-x-2">
                        <Link to={"/"}>
                            <span className="font-bold">KitchTech</span>
                        </Link>
                    </div>
                    <div className="hidden grow items-start lg:flex">
                        <ul className="ml-12 inline-flex space-x-8">
                            {menuItems.map((item) => (
                                <li key={item.name}>
                                    <Link to={item.href} className="text-sm font-semibold text-gray-800 hover:text-gray-900">
                                        {item.name}
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>
                    <div className="hidden lg:block">
                        {
                            useLogedIn === true ?
                                <>
                                    <button type='button' className="rounded-md bg-black px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-black/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black" >
                                        Hello, {userName}
                                    </button>
                                    <button type='button' onClick={userLogout} className="rounded-md bg-black px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-black/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black ml-2">
                                        Logout
                                    </button>
                                </>
                                : <Link to={"/login"} className="rounded-md bg-black px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-black/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black" >
                                    User Login
                                </Link>
                        }
                    </div>
                </div>
            </div >
        </>
    )
}

export default Header