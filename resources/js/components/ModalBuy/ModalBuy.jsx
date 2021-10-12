import React, { useState } from 'react'
import { Link } from "react-router-dom";
import { Launch32 } from '@carbon/icons-react';

import Modal from '../Modal/Modal'
import FormCreateOrder from '../Form/FormCreateOrder';

const ModalBuy = ({ product }) => {
    const [isOpen, setIsOpen] = useState(false)

    return (
        <>
            <p className="absolute right-2 top-2 bg-white rounded-full p-2 cursor-pointer group" onClick={() => setIsOpen(true)}>
                <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6 group-hover:opacity-50 opacity-70" fill="none" viewBox="0 0 24 24" stroke="black">
                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
            </p>
            <Modal
                isOpen={isOpen}
                closeModal={() => setIsOpen(false)}
                modalTitle={"Complete your order"}
                contentExtraClass="max-w-md"
                renderContent={() =>
                    <FormCreateOrder product={product} handleClose={() => setIsOpen(false)} />}
                buttonClose={() => (
                    <Link to={`/orders/create`} className="cursor-pointer border-none absolute right-2 top-1/2 transform -translate-y-1/2 sm:right-4">
                        <Launch32 />
                    </Link>
                )}
            />
        </>
    )
}

export default ModalBuy
