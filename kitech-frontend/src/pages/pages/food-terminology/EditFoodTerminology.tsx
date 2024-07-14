/* eslint-disable react-hooks/exhaustive-deps */
"use client";
import React, { useEffect, useState, ChangeEvent, FormEvent } from 'react';
import { toast } from "react-toastify";
import PostMethod from '../../../apiCalls/PostMethod';
import GetMethod from '../../../apiCalls/GetMethod';
import { useNavigate, useParams } from 'react-router-dom';

interface FoodType {
    id: string;
    name: string;
}

interface FootTerminology {
    terminology_name: string;
    terminology_number: string;
    food_type_id: string;
    id: string;
}

const EditFoodTerminology: React.FC = () => {
    const { id } = useParams<{ id: string }>();
    const navigate = useNavigate();

    const initialFormData: FootTerminology = {
        terminology_name: '',
        terminology_number: '',
        food_type_id: '',
        id: id || '',
    };

    const [formData, setFormData] = useState<FootTerminology>(initialFormData);
    const [foodTypeList, setFoodTypeList] = useState<FoodType[]>([]);
    const [buttonText, setButtonText] = useState<string>("Update Food Terminology");
    const [buttonDisabled, setButtonDisabled] = useState<boolean>(false);

    useEffect(() => {
        getFoodTypeData();
        getTerminologyData();
    }, []);

    const getFoodTypeData = async () => {
        const url = "food-type/index.php?name=list";
        const result = await GetMethod(url);
        const { status, data } = result;

        if (status) {
            setFoodTypeList(data);
        }
    };

    const getTerminologyData = async () => {
        const url = `food-terminology/index.php?name=details&food_terminology_id=${id}`;
        const result = await GetMethod(url);
        const { status, data } = result;

        if (status) {
            setFormData(data);
        }
    };

    const formHandler = async (e: FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        setButtonText("Loading...");
        setButtonDisabled(true);

        const url = "food-terminology/index.php?name=update";

        const requestData = new FormData();
        requestData.append('terminology_name', formData.terminology_name);
        requestData.append('terminology_number', formData.terminology_number);
        requestData.append('food_type_id', formData.food_type_id);
        requestData.append('id', formData.id);

        if (formData.terminology_name.trim()) {
            const response = await PostMethod(url, requestData);
            if (response) {
                const { status, message } = response;
                setButtonText("Update Food Terminology");

                if (status) {
                    setButtonDisabled(false);
                    setFormData(initialFormData);
                    toast.success(message);
                    navigate("/food-terminology");
                } else {
                    toast.error(message);
                    setButtonDisabled(false);
                }
            } else {
                setButtonText("Update Food Terminology");
                toast.error("Please try again");
                setButtonDisabled(false);
            }
        } else {
            setButtonText("Update Food Terminology");
            toast.error("Please Provide Food Name");
            setButtonDisabled(false);
        }
    };

    const handleInputChange = (e: ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
    };

    return (
        <section className="mx-auto w-full max-w-7xl px-4 py-4 mb-20">
            <div className="md:space-y-0">
                <div>
                    <h2 className="text-lg font-semibold">Manage Food Items</h2>
                    <div className="bg-gray-100 py-4 px-4 mt-4">
                        <form onSubmit={formHandler} method="post" autoComplete="off">
                            <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-4">
                                <div>
                                    <label htmlFor="terminology_name">Terminology Name</label>
                                    <input
                                        type="text"
                                        required
                                        className="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2"
                                        placeholder="Terminology Name"
                                        name="terminology_name"
                                        value={formData.terminology_name}
                                        onChange={handleInputChange}
                                    />
                                </div>
                                <div>
                                    <label htmlFor="terminology_number">Food Terminology No.</label>
                                    <input
                                        type="number"
                                        required
                                        className="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2"
                                        placeholder="Food Terminology No."
                                        name="terminology_number"
                                        value={formData.terminology_number}
                                        onChange={handleInputChange}
                                        min={0}
                                    />
                                </div>
                                <div>
                                    <label htmlFor="food_type_id">Food Category</label>
                                    <select
                                        className="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2"
                                        name="food_type_id"
                                        value={formData.food_type_id}
                                        onChange={handleInputChange}
                                    >
                                        <option value="" disabled> -- Select -- </option>
                                        {foodTypeList.map((data) => (
                                            <option key={data.id} value={data.id}>{data.name}</option>
                                        ))}
                                    </select>
                                </div>
                                <div className="mt-7">
                                    <button type="submit"
                                        className="inline-flex w-full items-center justify-center rounded-md bg-black px-3.5 py-1.5 font-semibold leading-7 text-white hover:bg-black/80"
                                        disabled={buttonDisabled}>
                                        {buttonText}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    )
};

export default EditFoodTerminology;