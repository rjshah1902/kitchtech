"use client"
import React from 'react'
import { Route, Routes } from 'react-router-dom'
import Home from '../pages/Home'
import FoodItems from '../pages/food-items/FoodItems'
import FoodTerminology from '../pages/food-terminology/FoodTerminology'
import PrivateRoutes from './PrivateRoutes'
import { ToastContainer } from "react-toastify";
import EditFoodItems from '../pages/food-items/EditFoodItems'
import EditFoodTerminology from '../pages/food-terminology/EditFoodTerminology'
import NursingHomeResidents from '../pages/home-residents/NursingHomeResidents'
import EditNursingHomeResidents from '../pages/home-residents/EditNursingHomeResidents'
import UploadCsv from '../pages/upload-csv/UploadCsv'

const Layout = () => {
    return (
        <>
            <ToastContainer />
            <Routes>
                <Route element={<PrivateRoutes />}>
                    <Route path="/" element={<Home />} />
                    <Route path="/food-items" element={<FoodItems />} />
                    <Route path="/food-items/:id" element={<EditFoodItems />} />
                    <Route path="/food-terminology" element={<FoodTerminology />} />
                    <Route path="/food-terminology/:id" element={<EditFoodTerminology />} />
                    <Route path="/home-residents" element={<NursingHomeResidents />} />
                    <Route path="/home-residents/:id" element={<EditNursingHomeResidents />} />
                    <Route path="/upload-csv" element={<UploadCsv />} />
                </Route>
            </Routes>
        </>
    )
}

export default Layout;