/* eslint-disable react-hooks/exhaustive-deps */
"use client";
import React, { useEffect, useState, ChangeEvent, FormEvent } from 'react';
import { toast } from "react-toastify";
import PostMethod from '../../../apiCalls/PostMethod';
import GetMethod from '../../../apiCalls/GetMethod';
import { useParams, useNavigate } from 'react-router-dom';
import InputTag from '../../components/InputTag';
import SelectTag from '../../components/SelectTag';

interface FoodType {
    id: string;
    name: string;
}

interface ManageFoodTerminologyProps {
    refreshList: () => void;
}

interface FoodTerminology {
    terminology_name: string;
    terminology_number: string;
    food_type_id: string;
    id: string;
}

const ManageFoodTerminology: React.FC<ManageFoodTerminologyProps> = ({ refreshList }) => {
    const { id } = useParams<{ id: string }>();
    const navigate = useNavigate();

    const initialFormData: FoodTerminology = {
        terminology_name: '',
        terminology_number: '',
        food_type_id: '',
        id: id || '',
    };

    const btnText: String = id ? "Update Food Terminology" : "Add Food Terminology";

    const [formData, setFormData] = useState<FoodTerminology>(initialFormData);
    const [foodTypeList, setFoodTypeList] = useState<FoodType[]>([]);
    const [buttonState, setButtonState] = useState({ text: btnText, disabled: false });

    useEffect(() => {

        getFoodTypeData();

        if (id) getTerminologyData();

    }, [id]);

    const getFoodTypeData = async () => {

        const url = "food-type/index.php?name=list";

        const { status, data } = await GetMethod(url);

        if (status) setFoodTypeList(data);
    };

    const getTerminologyData = async () => {

        const url = `food-terminology/index.php?name=details&food_terminology_id=${id}`;

        const { status, data } = await GetMethod(url);

        if (status) setFormData(data);
    };

    const formHandler = async (e: FormEvent<HTMLFormElement>) => {

        e.preventDefault();

        setButtonState({ text: "Loading...", disabled: true });

        const url = id ? "food-terminology/index.php?name=update" : "food-terminology/index.php?name=store";

        const requestData = new FormData();
        requestData.append('terminology_name', formData.terminology_name);
        requestData.append('terminology_number', formData.terminology_number);
        requestData.append('food_type_id', formData.food_type_id);
        requestData.append('id', formData.id);

        if (formData.terminology_name.trim()) {

            const { status, message } = await PostMethod(url, requestData);

            setButtonState({ text: btnText, disabled: false });

            if (status) {
                setFormData(initialFormData);
                toast.success(message);
                refreshList();
                navigate("/food-terminology");
            } else {
                toast.error(message);
            }
        } else {
            setButtonState({ text: btnText, disabled: false });
            toast.error("Please Provide Food Name");
        }
    };

    const handleInputChange = (e: ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
    };

    return (
        <section className="mx-auto w-full max-w-7xl py-4">
            <div className="md:space-y-0">
                <div>
                    <h2 className="text-lg font-semibold">Manage Food Items</h2>
                    <div className="bg-gray-100 py-4 px-4 mt-4 rounded-lg">
                        <form onSubmit={formHandler} method="post" autoComplete="off">
                            <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-4">

                                <div>
                                    <label htmlFor="terminology_name">Terminology Name</label>

                                    <InputTag inputType="text" inputName="terminology_name" inputLabel="Terminology Name" inputValue={formData.terminology_name} handleInputChange={handleInputChange} />
                                </div>

                                <div>
                                    <label htmlFor="terminology_number">Food Terminology No.</label>

                                    <InputTag inputType="number" inputName="terminology_number" inputLabel="Food Terminology No." inputValue={formData.terminology_number} handleInputChange={handleInputChange} />
                                </div>

                                <div>
                                    <label htmlFor="food_type_id">Food Category</label>

                                    <SelectTag inputValue={formData.food_type_id} handleInputChange={handleInputChange} inputName={'food_type_id'} selectArray={
                                        foodTypeList.map((data) => (
                                            <option key={data.id} value={data.id}>{data.name}</option>
                                        ))
                                    } />
                                </div>

                                <div className="mt-7">
                                    <button
                                        type="submit"
                                        className="inline-flex w-full items-center justify-center rounded-md bg-black px-3.5 py-1.5 font-semibold leading-7 text-white hover:bg-black/80"
                                        disabled={buttonState.disabled}
                                    >
                                        {buttonState.text}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    );
};

export default ManageFoodTerminology;