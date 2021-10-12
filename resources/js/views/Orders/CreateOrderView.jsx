import React from 'react'
import FormCreateOrder from '../../components/Form/FormCreateOrder'

const CreateOrderView = () => {
    return (
        <div className="w-full">
            <h2 className="text-center text-2xl my-3">Complete your order!</h2>
            <div className="flex justify-center">
                <FormCreateOrder formClassName="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" />
            </div>
        </div>
    )
}

export default CreateOrderView
