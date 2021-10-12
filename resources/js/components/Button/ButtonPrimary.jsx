import React from 'react'

const ButtonPrimary = ({
    onClick,
    text,
    type = "button"
}) => {
    return (
        <button type={type} onClick={onClick} className="mx-1 py-2 px-4 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
            {text}
        </button>
    );
}

export default ButtonPrimary
