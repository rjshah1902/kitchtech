import React from 'react'
import { Link } from 'react-router-dom'

interface FoodItem {
    url: string;
    iconType: any;
    title: string;
}

const DashboardCard: React.FC<FoodItem> = ({ url, iconType, title }) => {
    return (
        <div className='col px-10 lg:px-4'>
            <Link to={url}>
                <div className="w-full rounded-md p-6 border flex flex-col items-center">
                    {iconType}
                    <h2 className="text-xl font-semibold mt-4 italic">
                        {title}
                    </h2>
                </div>
            </Link>
        </div>
    )
}

export default DashboardCard
