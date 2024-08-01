/* eslint-disable react-hooks/exhaustive-deps */
"use client"
import React, { useEffect, useState } from 'react'
import { toast } from "react-toastify";
import PostMethod from '../../../apiCalls/PostMethod';
import GetMethod from '../../../apiCalls/GetMethod';
import { useNavigate, useParams } from 'react-router-dom';
import InputTag from '../../components/InputTag';
import SelectTag from '../../components/SelectTag';

interface FoodItem {
    food_name: string;
    food_category_id: string;
    food_type_id: string;
    food_terminology_id: string;
    id: any;
};

interface FoodItemsProps {
    refreshList: () => void;
}

const ManageFoodItems: React.FC<FoodItemsProps> = ({ refreshList }) => {

    const { id } = useParams();

    const navigate = useNavigate();

    const formFielddata: FoodItem = {
        food_name: '',
        food_category_id: '',
        food_type_id: '',
        food_terminology_id: '',
        id: id
    }

    const [formData, setFormData] = useState<FoodItem>(formFielddata);

    let btnText: string = id ? "Update Food Item" : "Add Food Item";

    const [foodCategoryList, setFoodCategoryList] = useState([]);
    const [foodTerminologyList, setFoodTerminologyList] = useState([]);
    const [buttonText, setButtonText] = useState<string>(btnText);
    const [buttonDisabled, setButtonDisabled] = useState<boolean>(false);

    useEffect(() => {
        getCategoryData();
        getTerminologyData();
        (id) && getFoodItemDetails();
    }, []);

    const getFoodItemDetails = async () => {

        const url = "food-item/index.php?name=details&food_item_id=" + id;

        const result = await GetMethod(url);

        const { status, data } = result;

        if (status === true) {
            setFormData(data);
        }
    };

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

    const formHandler = async (e: any) => {

        e.preventDefault();

        setButtonText("Loading...");

        setButtonDisabled(true);

        const url = id ? "food-item/index.php?name=update" : "food-item/index.php?name=store";


        const requesData = new FormData();
        requesData.append('food_name', formData.food_name);
        requesData.append('food_category_id', formData.food_category_id);
        requesData.append('food_type_id', formData.food_type_id);
        requesData.append('food_terminology_id', formData.food_terminology_id);
        requesData.append('id', formData.id);

        if (formData.food_name != null && formData.food_name !== "" && formData.food_name.length > 0) {
            let response = await PostMethod(url, requesData);
            if (response) {
                setButtonText(btnText);
                const { status, message } = response;
                if (status === true) {
                    setButtonDisabled(false);
                    setFormData(formFielddata);
                    toast.success(message);
                    refreshList();
                    navigate("/food-items");
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
                <div className="md:space-y-0">
                    <div>
                        <h2 className="text-lg font-semibold">Manage Food Items</h2>
                        <div className='bg-gray-100 py-4 px-4 mt-4 rounded-lg'>
                            <form onSubmit={formHandler} method="post" autoComplete={"off"}>
                                <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-4 ">
                                    <div>
                                        <label htmlFor="">Food Name</label>

                                        <InputTag inputType={'text'} inputValue={formData.food_name} handleInputChange={(e: any) => setFormData((prev) => ({ ...prev, food_name: e.target.value }))} inputName={'food_name'} inputLabel={'Food Name'} />
                                    </div>
                                    <div>
                                        <label htmlFor="">Food Category</label>

                                        <SelectTag
                                            inputValue={formData.food_category_id}
                                            handleInputChange={(e: any) => setFormData((prev) => ({ ...prev, food_category_id: e.target.value }))}
                                            inputName={'food_category_id'}
                                            selectArray={
                                                foodCategoryList.map((data: { id: string, category_name: string }, index) => <option key={index} value={data?.id}>{data.category_name}</option>)
                                            } />
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
                </div>
            </section>
        </>
    )
}

export default ManageFoodItems;