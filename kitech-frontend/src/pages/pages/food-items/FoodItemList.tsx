import React from 'react'
import { Link } from 'react-router-dom';

interface FoodItem {
    id: string;
    food_name: string;
    category_name: string;
    food_type: string;
    terminology_name: string;
}

interface FoodItemListProps {
    foodItem: FoodItem[];
    deleteItem: (id: number | string) => void;
}

const FoodItemList: React.FC<FoodItemListProps> = ({ foodItem, deleteItem }) => {

    return (
        <>
            {
                foodItem && foodItem.length > 0 &&
                <>
                    <div className="mt-6 flex flex-col">
                        <div className="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div className="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                                <div className="overflow-hidden border border-gray-200 md:rounded-lg">
                                    <table className="min-w-full divide-y divide-gray-200">
                                        <thead className="bg-gray-50">
                                            <tr className="divide-x divide-gray-200">
                                                <th scope="col" className="px-12 py-3.5 text-left text-sm font-semibold">
                                                    <span>Sr.</span>
                                                </th>
                                                <th scope="col" className="px-12 py-3.5 text-left text-sm font-semibold">
                                                    <span>Food Name</span>
                                                </th>
                                                <th scope="col" className="px-12 py-3.5 text-left text-sm font-semibold">
                                                    Category
                                                </th>
                                                <th scope="col" className="px-12 py-3.5 text-left text-sm font-semibold">
                                                    Food Type
                                                </th>
                                                <th scope="col" className="px-12 py-3.5 text-left text-sm font-semibold">
                                                    Food Terminology
                                                </th>
                                                <th scope="col" className="px-12 py-3.5 text-left text-sm font-semibold">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody className="divide-y divide-gray-200 bg-white">
                                            {foodItem.map((data: { id: string, food_name: string, category_name: string, food_type: string, terminology_name: string }, index) => (
                                                <tr key={index} className="divide-x divide-gray-200">
                                                    <td className="whitespace-nowrap px-12 py-4">
                                                        {index + 1}
                                                    </td>
                                                    <td className="whitespace-nowrap px-4 py-4">
                                                        <div className="flex items-center">
                                                            <div className="ml-4">
                                                                <div className="text-sm font-medium text-gray-900">{data?.food_name}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td className="whitespace-nowrap px-12 py-4">
                                                        <div className="text-sm text-gray-900">{data?.category_name}</div>
                                                    </td>
                                                    <td className="whitespace-nowrap px-12 py-4">
                                                        <div className="text-sm text-gray-500">{data?.food_type}</div>
                                                    </td>
                                                    <td className="whitespace-nowrap px-12 py-4">
                                                        <div className="text-sm text-gray-500">{data?.terminology_name}</div>
                                                    </td>
                                                    <td className="whitespace-nowrap px-4 py-4 text-right text-sm font-medium">
                                                        <Link to={`/food-items/${data.id}`} className="bg-yellow-600 px-4 py-2 text-white rounded-md">
                                                            Edit
                                                        </Link>
                                                        <button onClick={(e: any) => deleteItem(data.id)} className='bg-red-600 text-white rounded-md px-4 py-2 ml-2'>
                                                            Delete
                                                        </button>
                                                    </td>
                                                </tr>
                                            ))}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </>
            }
        </>
    )
}

export default FoodItemList
