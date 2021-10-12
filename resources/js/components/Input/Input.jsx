import React from "react";

const Input = (
    (
        {
            className = "",
            sizeClass = "h-11 px-4 py-3",
            fontClass = "text-sm font-normal",
            rounded = "rounded-full",
            children,
            type = "text",
            ...args
        }
    ) => {
        return (
            <>
                <input
                    type={type}
                    className={`shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline ${rounded} ${fontClass} ${sizeClass} ${className}`}
                    {...args}
                />
            </>
        );
    }
);

export default Input;
