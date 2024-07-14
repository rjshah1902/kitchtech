import React from 'react'
import { Link } from 'react-router-dom';

interface FoodItem {
    id: string;
    terminology_name: string;
    terminology_number: string;
    food_type: string;
}

interface FoodTerminologyListProps {
    foodItem: FoodItem[];
}

const FoodTerminologyList: React.FC<FoodTerminologyListProps> = ({ foodItem }) => {

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
                                                <th scope="col" className="px-3 md:px-12 py-3.5 text-left text-sm font-semibold">
                                                    <span>Sr.</span>
                                                </th>
                                                <th scope="col" className="px-3 md:px-12 py-3.5 text-left text-sm font-semibold">
                                                    <span>Food Name</span>
                                                </th>
                                                <th scope="col" className="px-3 md:px-12 py-3.5 text-left text-sm font-semibold">
                                                    Food Type
                                                </th>
                                                <th scope="col" className="px-3 md:px-12 py-3.5 text-left text-sm font-semibold">
                                                    Terminology No.
                                                </th>
                                                <th scope="col" className="px-3 md:px-12 py-3.5 text-left text-sm font-semibold">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody className="divide-y divide-gray-200 bg-white">
                                            {foodItem.map((data: { id: string, terminology_name: string, terminology_number: string, food_type: string }, index) => (
                                                <tr key={index} className="divide-x divide-gray-200">
                                                    <td className="whitespace-nowrap px-3 md:px-12 py-4">
                                                        {index + 1}
                                                    </td>
                                                    <td className="whitespace-nowrap px-4 py-4">
                                                        <div className="flex items-center">
                                                            <div className="ml-4">
                                                                <div className="text-sm font-medium text-gray-900">{data?.terminology_name}</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td className="whitespace-nowrap px-3 md:px-12 py-4">
                                                        <div className="text-sm text-gray-500">{data?.food_type}</div>
                                                    </td>
                                                    <td className="whitespace-nowrap px-3 md:px-12 py-4">
                                                        <div className="text-sm text-gray-500">{data?.terminology_number}</div>
                                                    </td>
                                                    <td className="whitespace-nowrap px-4 py-4 text-right text-sm font-medium">
                                                        <Link to={`/food-terminology/${data.id}`} className="bg-yellow-600 px-4 py-2 text-white rounded-md">
                                                            Edit
                                                        </Link>
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

export default FoodTerminologyList
