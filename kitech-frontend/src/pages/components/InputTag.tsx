import React, { ChangeEvent } from 'react';

interface InputTagProps {
    inputType: string;
    inputValue: string;
    handleInputChange: (e: ChangeEvent<HTMLInputElement>) => void;
    inputName: string;
    inputLabel: string;
}

const InputTag: React.FC<InputTagProps> = ({ inputType, inputName, inputLabel, inputValue, handleInputChange }) => {
    return (
        <input
            type={inputType}
            required
            className="flex h-10 w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-offset-1 disabled:cursor-not-allowed disabled:opacity-50 mt-2"
            placeholder={inputLabel}
            name={inputName}
            value={inputValue}
            onChange={handleInputChange}
        />
    );
}

export default InputTag;
