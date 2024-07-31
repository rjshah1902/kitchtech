"use client"
import React, { useEffect, useState } from 'react'
import { toast } from "react-toastify";
import PostMethod from '../../../apiCalls/PostMethod';
import GetMethod from '../../../apiCalls/GetMethod';
import NursingHomeResidentsList from './NursingHomeResidentsList';
import { confirmAlert } from 'react-confirm-alert';
import 'react-confirm-alert/src/react-confirm-alert.css';
import ManageNursingHomeResidents from './ManageNursingHomeResidents';


const NursingHomeResidents: React.FC = () => {

    const [foodItem, setFoodItem] = useState([]);

    useEffect(() => {
        getFoodItemData();
    }, []);

    const getFoodItemData = async () => {

        const url = "home-residents/index.php?name=list";

        const result = await GetMethod(url);

        const { status, data } = result;

        if (status === true) {
            setFoodItem(data);
        }
    }

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

                <ManageNursingHomeResidents />

                {/* Add Home Residents Section End */}


                {/*  Home Residents List  Section Start */}

                <NursingHomeResidentsList foodItem={foodItem} deleteItem={(id: any) => deleteItem(id)} />

                {/*  Home Residents List  Section End */}

            </section>
        </>
    )
}

export default NursingHomeResidents;