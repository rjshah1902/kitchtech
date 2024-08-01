"use client"
import React, { FormEvent, useEffect, useState } from 'react'
import { toast } from "react-toastify";
import PostMethod from '../../../apiCalls/PostMethod';
import GetMethod from '../../../apiCalls/GetMethod';
import FoodItemList from './FoodItemList';
import { confirmAlert } from 'react-confirm-alert';
import 'react-confirm-alert/src/react-confirm-alert.css';
import ManageFoodItems from './ManageFoodItems';
import InputTag from '../../components/InputTag';


const FoodItems: React.FC = () => {

    const [foodItem, setFoodItem] = useState([]);
    const [searchData, setSearchData] = useState<string>("");

    useEffect(() => {
        getFoodItemData();
    }, []);

    const getFoodItemData = async (search = "") => {

        const url = "food-item/index.php?name=list&search=" + search;

        const result = await GetMethod(url);

        const { status, data } = result;

        if (status === true) {
            setFoodItem(data);
        }
    }


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

                <ManageFoodItems refreshList={getFoodItemData} />

                {/* Add Food Item Section End */}


                {/* Search Food Item Section Start */}
                <div className="row">
                    <div className='rounded-lg bg-gray-100 py-4 px-4 mt-4'>
                        <form onSubmit={searchFoodItem} method="post" autoComplete={"off"}>
                            <div className="grid gap-6 md:grid-cols-1 lg:grid-cols-4">
                                <div>
                                    <InputTag
                                        inputType={'text'}
                                        inputValue={searchData}
                                        handleInputChange={(e: any) => setSearchData(e.target.value)}
                                        inputName={'searchData'}
                                        inputLabel={'Food Name'} />

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