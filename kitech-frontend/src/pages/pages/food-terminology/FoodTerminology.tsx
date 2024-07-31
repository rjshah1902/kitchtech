"use client"
import React, { useEffect, useState } from 'react'
import GetMethod from '../../../apiCalls/GetMethod';
import FoodTerminologyList from './FoodTerminologyList';
import ManageFoodTerminology from './ManageFoodTerminology';

const FoodTerminology: React.FC = () => {


    const [foodTerminologyList, setFoodTerminologyList] = useState([]);

    useEffect(() => {
        getFoodItemData();
    }, []);


    const getFoodItemData = async () => {

        const url = "food-terminology/index.php?name=list";

        const result = await GetMethod(url);

        const { status, data } = result;

        if (status === true) {
            setFoodTerminologyList(data);
        }
    }



    return (
        <>
            <section className="mx-auto w-full max-w-7xl px-4 py-4 mb-20">

                {/* Add Food Terminology Section Start */}

                <ManageFoodTerminology />

                {/* Add Food Terminology Section End */}



                {/*  Food Terminology List  Section Start */}

                <FoodTerminologyList foodItem={foodTerminologyList} />

                {/*  Food Terminology List  Section End */}

            </section>
        </>
    )
}

export default FoodTerminology;