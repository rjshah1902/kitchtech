"use client"
import React, { FormEvent, useEffect, useState } from 'react'
import { toast } from "react-toastify";
import PostMethod from '../../../apiCalls/PostMethod';
import GetMethod from '../../../apiCalls/GetMethod';
import FoodTerminologyList from './FoodTerminologyList';

interface FootItem {
    terminology_name: string;
    terminology_number: string;
    food_type_id: string;
};

const FoodTerminology: React.FC = () => {

    const formFielddata: FootItem = {
        terminology_name: '',
        terminology_number: '',
        food_type_id: '',
    }

    const [formData, setFormData] = useState<FootItem>(formFielddata);

    const btnText = "Add Food Terminology";

    const [foodTypeList, setFoodTypeList] = useState([]);
    const [foodTerminologyList, setFoodTerminologyList] = useState([]);
    const [buttonText, setButtonText] = useState<string>(btnText);
    const [buttonDisabled, setButtonDisabled] = useState<boolean>(false);

    useEffect(() => {
        getFoodItemData();
        getFoodTypeData();
    }, []);

    const getFoodTypeData = async () => {

        const url = "food-type/index.php?name=list";

        const result = await GetMethod(url);

        const { status, data } = result;

        if (status === true) {
            setFoodTypeList(data);
        }
    }

    const getFoodItemData = async () => {

        const url = "food-terminology/index.php?name=list";

        const result = await GetMethod(url);

        const { status, data } = result;

        if (status === true) {
            setFoodTerminologyList(data);
        }
    }

    const formHandler = async (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        setButtonText("Loading...");
        setButtonDisabled(true);

        const url = "food-terminology/index.php?name=store";

        const requesData = new FormData();
        requesData.append('terminology_name', formData.terminology_name);
        requesData.append('terminology_number', formData.terminology_number);
        requesData.append('food_type_id', formData.food_type_id);

        if (formData.terminology_name != null && formData.terminology_name !== "" && formData.terminology_name.length > 0) {
            let response = await PostMethod(url, requesData);
            if (response) {
                setButtonText(btnText);
                const { status, message } = response;
                if (status === true) {
                    setButtonDisabled(false);
                    getFoodItemData();
                    setFormData(formFielddata);
                    toast.success(message);
                } else {
                    toast.error(message);
                    setButtonDisabled(false);
                }
            } else {
                setButtonText(btnText);
                toast.error("Please try again");
                setButtonDisabled(false);
            }
        } else {
            setButtonText(btnText);
            toast.error("Please Provide Food Name");
            setButtonDisabled(false);
        }
    }


    return (
        <>
            <section className="mx-auto w-full max-w-7xl px-4 py-4 mb-20">

                {/* Add Food Terminology Section Start */}

                <div className="row">
                    <h2 className="text-lg font-semibold">Manage Food Terminologys</h2>
                    <div className='rounded-lg bg-gray-100 py-4 px-4 mt-4'>
                        <form onSubmit={formHandler} method="post" autoComplete={"off"}>
                            <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-4">
                                <div>
                                    <label htmlFor="">Terminology Name</label>
                                    <input type="text" required className='flex h-10 w-full rounded-md border border-gray-300  px-3 py-2 text-sm  focus:outline-none focus:ring-1focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2' placeholder='Terminology Name' name='terminology_name' value={formData.terminology_name} onChange={(e: any) => setFormData((prev) => ({ ...prev, terminology_name: e.target.value }))} />
                                </div>
                                <div>
                                    <label htmlFor="">Food Terminology No.</label>
                                    <input type="number" required className='flex h-10 w-full rounded-md border border-gray-300  px-3 py-2 text-sm  focus:outline-none focus:ring-1focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2' placeholder='Food Terminology No.' name='terminology_number' value={formData.terminology_number} onChange={(e: any) => setFormData((prev) => ({ ...prev, terminology_number: e.target.value }))} min={0} />
                                </div>
                                <div>
                                    <label htmlFor="">Food Category</label>
                                    <select className='flex h-10 w-full rounded-md border border-gray-300  px-3 py-2 text-sm  focus:outline-none focus:ring-1focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2' name='food_type_id' value={formData.food_type_id} onChange={(e: any) => setFormData((prev) => ({ ...prev, food_type_id: e.target.value }))} >
                                        <option value="" selected disabled> -- Select -- </option>
                                        {
                                            foodTypeList.map((data: { id: string, name: string }, index) => <option key={index} value={data?.id}>{data.name}</option>)
                                        }
                                    </select>
                                </div>
                                <div className='mt-7'>
                                    <button type='submit' className="inline-flex w-full items-center justify-center rounded-md bg-black px-3.5 py-1.5 font-semibold leading-7 text-white hover:bg-black/80" disabled={buttonDisabled} >
                                        {buttonText}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                {/* Add Food Terminology Section End */}



                {/*  Food Terminology List  Section Start */}

                <FoodTerminologyList foodItem={foodTerminologyList} />

                {/*  Food Terminology List  Section End */}

            </section>
        </>
    )
}

export default FoodTerminology;