import React from 'react'
import ModalBuy from '../ModalBuy/ModalBuy'

const ProductListItem = ({ product }) => {
    return (
        <div className="relative max-w-sm min-w-[340px] bg-white shadow-md rounded-3xl p-2 mx-1 my-3 cursor-pointer">
            <div className="overflow-x-hidden rounded-2xl relative">
                <img className="h-60 rounded-2xl w-full object-cover" src="https://pixahive.com/wp-content/uploads/2020/10/Gym-shoes-153180-pixahive.jpg" />
                <ModalBuy product={product} />
            </div>
            <div className="mt-4 pl-2 mb-2 pb-2 flex justify-between ">
                <div>
                    <p className="text-lg font-semibold text-gray-900 mb-0">{product.name}</p>
                    <p className="text-md text-gray-800 mt-0">${product.price}</p>
                </div>
            </div>
        </div>
    )
}

export default ProductListItem
