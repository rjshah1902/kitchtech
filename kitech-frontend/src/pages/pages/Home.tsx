import React from 'react'
import { Utensils, LayoutList, Sheet, ClipboardPlus } from 'lucide-react';
import DashboardCard from '../components/DashboardCard';



const Home: React.FC = () => {
    return (
        <>
            <section className="mx-auto w-full max-w-7xl flex flex-col items-center justify-center">
                <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-4 mt-20 w-full">

                    <DashboardCard url="/food-items" iconType={<LayoutList />} title="Food Items" />

                    <DashboardCard url="/food-terminology" iconType={<Utensils />} title="Food Terminology" />

                    <DashboardCard url="/home-residents" iconType={<ClipboardPlus />} title="Nursing Home Residents" />

                    <DashboardCard url="/upload-csv" iconType={<Sheet />} title="Upload CSV" />

                </div>
            </section>
        </>
    )
}

export default Home