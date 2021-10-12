import React from 'react'

const ButtonSecondary = ({
    onClick,
    text
}) => {
    return (
        <button onClick={onClick} className="mx-1 py-2 px-4 bg-gray-400 text-white font-semibold rounded-lg shadow-md hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-200 focus:ring-opacity-75">
            {text}
        </button>
    )
}

export default ButtonSecondary
