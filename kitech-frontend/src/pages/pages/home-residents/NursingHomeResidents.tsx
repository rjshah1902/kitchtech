"use client"
import React, { useEffect, useState } from 'react'
import { toast } from "react-toastify";
import PostMethod from '../../../apiCalls/PostMethod';
import GetMethod from '../../../apiCalls/GetMethod';
import NursingHomeResidentsList from './NursingHomeResidentsList';
import { confirmAlert } from 'react-confirm-alert';
import 'react-confirm-alert/src/react-confirm-alert.css';

interface HomeResident {
    name: string;
    food_type_id: string;
    food_terminology_id: string;
};

const NursingHomeResidents: React.FC = () => {

    const formFielddata: HomeResident = {
        name: '',
        food_type_id: '',
        food_terminology_id: ''
    }

    const [formData, setFormData] = useState<HomeResident>(formFielddata);

    const btnText = "Add Home Residents";

    const [foodItem, setFoodItem] = useState([]);
    const [foodTerminologyList, setFoodTerminologyList] = useState([]);
    const [buttonText, setButtonText] = useState<string>(btnText);
    const [buttonDisabled, setButtonDisabled] = useState<boolean>(false);
    const [searchData, setSearchData] = useState<string>("");

    useEffect(() => {
        getFoodItemData();
        getTerminologyData();
    }, []);

    const getFoodItemData = async () => {

        const url = "home-residents/index.php?name=list";

        const result = await GetMethod(url);

        const { status, data } = result;

        if (status === true) {
            setFoodItem(data);
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

    const formHandler = async (e: any) => {
        e.preventDefault();
        setButtonText("Loading...");
        setButtonDisabled(true);

        const url = "home-residents/index.php?name=store";

        const requesData = new FormData();
        requesData.append('name', formData.name);
        requesData.append('food_type_id', formData.food_type_id);
        requesData.append('food_terminology_id', formData.food_terminology_id);

        if (formData.name != null && formData.name != "" && formData.name.length > 0) {
            let response = await PostMethod(url, requesData);
            if (response) {
                setButtonText(btnText);
                const { status, message, data } = response;
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

    const deleteItem = (id: any) => {
        confirmAlert({
            title: 'Confirm to delete',
            message: 'Are you sure to delete this data...!',
            buttons: [
                {
                    label: 'Yes',
                    onClick: async () => {
                        const url = "home-residents/index.php?name=delete";
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

                {/* Add Home Residents Section Start */}

                <div className="row">
                    <h2 className="text-lg font-semibold">Manage Home Residents</h2>
                    <div className='rounded-lg bg-gray-100 py-4 px-4 mt-4'>
                        <form onSubmit={formHandler} method="post" autoComplete={"off"}>
                            <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-3">
                                <div>
                                    <label htmlFor="">Name</label>
                                    <input type="text" required className='flex h-10 w-full rounded-md border border-gray-300  px-3 py-2 text-sm  focus:outline-none focus:ring-1focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2' placeholder='Name' name='name' value={formData.name} onChange={(e: any) => setFormData((prev) => ({ ...prev, name: e.target.value }))} />
                                </div>
                                <div>
                                    <label htmlFor="">Food Terminology</label>
                                    <select className='flex h-10 w-full rounded-md border border-gray-300  px-3 py-2 text-sm  focus:outline-none focus:ring-1focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2' name='food_terminology_id' value={formData.food_terminology_id} onChange={(e: any) => updateFoodTerminology(e)} >
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

                {/* Add Home Residents Section End */}


                {/*  Home Residents List  Section Start */}

                <NursingHomeResidentsList foodItem={foodItem} deleteItem={(id: any) => deleteItem(id)} />

                {/*  Home Residents List  Section End */}

            </section>
        </>
    )
}

export default NursingHomeResidents;