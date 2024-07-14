"use client"
import React, { FormEvent, useEffect, useState } from 'react'
import { toast } from "react-toastify";
import PostMethod from '../../../apiCalls/PostMethod';
import GetMethod from '../../../apiCalls/GetMethod';
import FoodItemList from './FoodItemList';
import { confirmAlert } from 'react-confirm-alert';
import 'react-confirm-alert/src/react-confirm-alert.css';

interface FootItem {
    food_name: string;
    food_category_id: string;
    food_type_id: string;
    food_terminology_id: string;
};

const FoodItems: React.FC = () => {

    const formFielddata: FootItem = {
        food_name: '',
        food_category_id: '',
        food_type_id: '',
        food_terminology_id: ''
    }

    const [formData, setFormData] = useState<FootItem>(formFielddata);

    const btnText = "Add Food Item";

    const [foodItem, setFoodItem] = useState([]);
    const [foodCategoryList, setFoodCategoryList] = useState([]);
    const [foodTerminologyList, setFoodTerminologyList] = useState([]);
    const [buttonText, setButtonText] = useState<string>(btnText);
    const [buttonDisabled, setButtonDisabled] = useState<boolean>(false);
    const [searchData, setSearchData] = useState<string>("");

    useEffect(() => {
        getFoodItemData();
        getCategoryData();
        getTerminologyData();
    }, []);

    const getFoodItemData = async (search = "") => {

        const url = "food-item/index.php?name=list&search=" + search;

        const result = await GetMethod(url);

        const { status, data } = result;

        if (status === true) {
            setFoodItem(data);
        }
    }

    const getCategoryData = async () => {

        const url = "food-category/index.php?name=list";

        const result = await GetMethod(url);

        const { status, data } = result;

        if (status === true) {
            setFoodCategoryList(data);
        }
    }

    const getTerminologyData = async () => {

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

        const url = "food-item/index.php?name=store";

        const requesData = new FormData();
        requesData.append('food_name', formData.food_name);
        requesData.append('food_category_id', formData.food_category_id);
        requesData.append('food_type_id', formData.food_type_id);
        requesData.append('food_terminology_id', formData.food_terminology_id);

        if (formData.food_name != null && formData.food_name !== "" && formData.food_name.length > 0) {
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

    const updateFoodTerminology = (e: any) => {

        const selectedIndex = e.target.selectedIndex;
        const selectedTypeId = e.target.options[selectedIndex].getAttribute('data-typeId');

        setFormData((prev) => ({ ...prev, food_type_id: selectedTypeId, food_terminology_id: e.target.value }));
    };

    const searchFoodItem = (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        getFoodItemData(searchData);
    }

    const resetData = (e: any) => {
        e.preventDefault();
        setSearchData("");
        getFoodItemData("");
    }

    const deleteItem = (id: any) => {
        confirmAlert({
            title: 'Confirm to delete',
            message: 'Are you sure to delete this data...!',
            buttons: [
                {
                    label: 'Yes',
                    onClick: async () => {
                        const url = "food-item/index.php?name=delete";
                        const deleteData = new FormData();
                        deleteData.append('id', id);
                        const result = await PostMethod(url, deleteData);
                        const { status, message } = result;
                        if (status === true) {
                            toast.success(message);
                            getFoodItemData();
                        }
                    }
                },
                {
                    label: 'No',
                    onClick: () => null
                }
            ]
        });
    }

    return (
        <>
            <section className="mx-auto w-full max-w-7xl px-4 py-4 mb-20">

                {/* Add Food Item Section Start */}

                <div className="row">
                    <h2 className="text-lg font-semibold">Manage Food Items</h2>
                    <div className='rounded-lg bg-gray-100 py-4 px-4 mt-4'>
                        <form onSubmit={formHandler} method="post" autoComplete={"off"}>
                            <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-4 ">
                                <div>
                                    <label htmlFor="">Food Name</label>
                                    <input type="text" required className='flex h-10 w-full rounded-md border border-gray-300  px-3 py-2 text-sm  focus:outline-none focus:ring-1focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2' placeholder='Food Name' name='food_name' value={formData.food_name} onChange={(e: any) => setFormData((prev) => ({ ...prev, food_name: e.target.value }))} />
                                </div>
                                <div>
                                    <label htmlFor="">Food Category</label>
                                    <select required className='flex h-10 w-full rounded-md border border-gray-300  px-3 py-2 text-sm  focus:outline-none focus:ring-1focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2' name='food_category_id' value={formData.food_category_id} onChange={(e: any) => setFormData((prev) => ({ ...prev, food_category_id: e.target.value }))} >
                                        <option value="" selected disabled> -- Select -- </option>
                                        {
                                            foodCategoryList.map((data: { id: string, category_name: string }, index) => <option key={index} value={data?.id}>{data.category_name}</option>)
                                        }
                                    </select>
                                </div>
                                <div>
                                    <label htmlFor="">Food Terminology</label>
                                    <select required className='flex h-10 w-full rounded-md border border-gray-300  px-3 py-2 text-sm  focus:outline-none focus:ring-1focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2' name='food_terminology_id' value={formData.food_terminology_id} onChange={(e: any) => updateFoodTerminology(e)} >
                                        <option value="" selected disabled> -- Select -- </option>
                                        {
                                            foodTerminologyList.map((data: { id: string, food_type_id: string, terminology_name: string }, index) =>
                                                <option key={index} value={data?.id} data-typeId={data?.food_type_id}>{data.terminology_name}</option>)
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

                {/* Add Food Item Section End */}


                {/* Search Food Item Section Start */}
                <div className="row">
                    <div className='rounded-lg bg-gray-100 py-4 px-4 mt-4'>
                        <form onSubmit={searchFoodItem} method="post" autoComplete={"off"}>
                            <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-4">
                                <div>
                                    <input type="text" required className='flex w-full rounded-md border border-gray-300  px-3 py-3 text-sm  focus:outline-none focus:ring-1focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2' placeholder='Food Name' name='searchData' value={searchData} onChange={(e: any) => setSearchData(e.target.value)} />
                                </div>
                                <div className='mt-2'>
                                    <button type='submit' className="inline-flex w-full items-center justify-center rounded-md bg-black px-3.5 py-2 font-semibold leading-7 text-white hover:bg-black/80">
                                        Search
                                    </button>
                                </div>
                                <div className='mt-2'>
                                    <button type='button' onClick={resetData} className="inline-flex w-full items-center justify-center rounded-md bg-black px-3.5 py-2 font-semibold leading-7 text-white hover:bg-black/80">
                                        Reset
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                {/* Search Food Item Section End */}


                {/*  Food Item List  Section Start */}

                <FoodItemList foodItem={foodItem} deleteItem={(id: any) => deleteItem(id)} />

                {/*  Food Item List  Section End */}

            </section>
        </>
    )
}

export default FoodItems;