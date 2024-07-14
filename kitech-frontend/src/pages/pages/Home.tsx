import React from 'react'
import { Link } from 'react-router-dom'
import { Utensils, LayoutList, Sheet, ClipboardPlus } from 'lucide-react';



const Home: React.FC = () => {
    return (
        <>
            <section className="mx-auto w-full max-w-7xl flex flex-col items-center justify-center">
                <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-4 mt-20 w-full">
                    <div className='col px-10 lg:px-4'>
                        <Link to={"/food-items"}>
                            <div className="w-full rounded-md p-6 border flex flex-col items-center">
                                <LayoutList />
                                <h2 className="text-2xl font-semibold mt-4 italic">
                                    Food Items
                                </h2>
                            </div>
                        </Link>
                    </div>
                    <div className='col px-10 lg:px-4'>
                        <Link to={"/food-terminology"}>
                            <div className="w-full rounded-md p-6 border flex flex-col items-center">
                                <Utensils />
                                <h2 className="text-2xl font-semibold mt-4 italic">
                                    Food Terminology
                                </h2>
                            </div>
                        </Link>
                    </div>
                    <div className='col px-10 lg:px-4'>
                        <Link to={"/home-residents"}>
                            <div className="w-full rounded-md p-6 border flex flex-col items-center">
                                <ClipboardPlus />
                                <h2 className="text-xl font-semibold mt-4 italic">
                                    Nursing Home Residents
                                </h2>
                            </div>
                        </Link>
                    </div>
                    <div className='col px-10 lg:px-4'>
                        <Link to={"/upload-csv"}>
                            <div className="w-full rounded-md p-6 border flex flex-col items-center">
                                <Sheet />
                                <h2 className="text-2xl font-semibold mt-4 italic">
                                    Upload CSV
                                </h2>
                            </div>
                        </Link>
                    </div>
                </div>
            </section>
        </>
    )
}

export default Home