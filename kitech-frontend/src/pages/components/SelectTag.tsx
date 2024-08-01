import React, { ChangeEvent } from 'react';

interface SelectTagProps {
    inputValue: string;
    handleInputChange: (e: ChangeEvent<HTMLSelectElement>) => void;
    inputName: string;
    selectArray: any[];
}

const SelectTag: React.FC<SelectTagProps> = ({ inputName, selectArray, inputValue, handleInputChange, }) => {
    return (
        <select
            className="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2"
            name={inputName}
            value={inputValue}
            onChange={handleInputChange}>
            <option value="" disabled> -- Select -- </option>
            {selectArray}
        </select>
    );
}

export default SelectTag;
