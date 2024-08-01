/* eslint-disable react-hooks/exhaustive-deps */
"use client"
import React, { useEffect, useState } from 'react'
import { toast } from "react-toastify";
import PostMethod from '../../../apiCalls/PostMethod';
import GetMethod from '../../../apiCalls/GetMethod';
import { useNavigate, useParams } from 'react-router-dom';
import InputTag from '../../components/InputTag';
import SelectTag from '../../components/SelectTag';

interface HomeResidents {
    name: string;
    food_type_id: string;
    food_terminology_id: string;
    id: any;
};

interface HomeResidentsProps {
    refreshList: () => void;
}

const ManageNursingHomeResidents: React.FC<HomeResidentsProps> = ({ refreshList }) => {

    const { id } = useParams();

    const navigate = useNavigate();

    const formFielddata: HomeResidents = {
        name: '',
        food_type_id: '',
        food_terminology_id: '',
        id: id
    }

    const [formData, setFormData] = useState<HomeResidents>(formFielddata);

    let btnText: string = id ? "Update Home Residents" : "Add Home Residents";

    const [foodTerminologyList, setFoodTerminologyList] = useState([]);
    const [buttonText, setButtonText] = useState<string>(btnText);
    const [buttonDisabled, setButtonDisabled] = useState<boolean>(false);

    useEffect(() => {
        (id) && getHomeResidentsDetails();
        getTerminologyData();
    }, []);

    const getHomeResidentsDetails = async () => {

        const url = "home-residents/index.php?name=details&id=" + id;

        const result = await GetMethod(url);

        const { status, data } = result;

        if (status === true) {
            setFormData(data);
        }
    };

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

        const url = id ? "home-residents/index.php?name=update" : "home-residents/index.php?name=store";

        const requesData = new FormData();
        requesData.append('name', formData.name);
        requesData.append('food_type_id', formData.food_type_id);
        requesData.append('food_terminology_id', formData.food_terminology_id);
        requesData.append('id', formData.id);

        if (formData.name != null && formData.name !== "" && formData.name.length > 0) {
            let response = await PostMethod(url, requesData);
            if (response) {
                setButtonText(btnText);
                const { status, message } = response;
                if (status === true) {
                    setButtonDisabled(false);
                    setFormData(formFielddata);
                    toast.success(message);
                    refreshList();
                    navigate("/home-residents");
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

    return (
        <>
            <section className="mx-auto w-full max-w-7xl py-4">
                <div className="row">
                    <h2 className="text-lg font-semibold">Manage Home Residents</h2>
                    <div className=' bg-gray-100 py-4 px-4 mt-4 rounded-lg'>
                        <form onSubmit={formHandler} method="post" autoComplete={"off"}>
                            <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-3">
                                <div>
                                    <label htmlFor="">Name</label>

                                    <InputTag
                                        inputType={'text'}
                                        inputValue={formData.name}
                                        handleInputChange={(e: any) => setFormData((prev) => ({ ...prev, name: e.target.value }))}
                                        inputName={'name'}
                                        inputLabel={'Name'} />
                                </div>
                                <div>
                                    <label htmlFor="">Food Terminology</label>
                                    <SelectTag
                                        inputValue={formData.food_terminology_id}
                                        handleInputChange={(e: any) => updateFoodTerminology(e)}
                                        inputName={'food_terminology_id'}
                                        selectArray={
                                            foodTerminologyList.map((data: { id: string, food_type_id: string, terminology_name: string }, index) =>
                                                <option key={index} value={data?.id} data-typeId={data?.food_type_id}>{data.terminology_name}</option>)
                                        } />
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
            </section>
        </>
    )
}

export default ManageNursingHomeResidents;