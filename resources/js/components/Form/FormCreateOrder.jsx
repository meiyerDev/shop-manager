import React, { useEffect } from 'react'
import { useHistory } from 'react-router-dom'
import { useLocation } from 'react-router-dom/cjs/react-router-dom.min'
import { useOrder } from '../../contexts/order-context'
import ButtonPrimary from '../Button/ButtonPrimary'
import ButtonSecondary from '../Button/ButtonSecondary'
import Input from '../Input/Input'

const FormCreateOrder = ({ product, handleClose, formClassName }) => {
    const { state: { fields }, actions } = useOrder();
    let location = useLocation();
    let history = useHistory();

    const handleChange = (e) => {
        actions.setFormFieldsToCreate({
            [e.target.name]: e.target.value,
        })
    }

    const handleCanceled = () => {
        if (location.pathname === '/') {
            handleClose();
            return;
        }
        history.push('/');
    }

    const handleSubmit = (e) => {
        e.preventDefault();
        actions.postCreate(fields);
    }

    useEffect(() => {
        actions.setFormFieldsToCreate({
            product: product ?? fields.product,
            product_id: product?.id ?? fields.product_id,
        })
    }, [])

    return (
        <form className={formClassName} onSubmit={handleSubmit}>
            <div className="my-3">
                <div className="py-3">
                    <label>Customer name</label>
                    <Input name="customer_name" value={fields.customer_name} placeholder="Customer name" className="my-2" onChange={handleChange} />
                </div>
                <div className="py-3">
                    <label>Customer email</label>
                    <Input name="customer_email" value={fields.customer_email} type="email" placeholder="Customer email" className="my-2" onChange={handleChange} />
                </div>
                <div className="py-3">
                    <label>Customer mobile</label>
                    <Input name="customer_mobile" value={fields.customer_mobile} placeholder="Customer mobile" className="my-2" onChange={handleChange} />
                </div>
                <div className="mt-4 text-right ">
                    <ButtonSecondary text="Cancelar" onClick={handleCanceled} />
                    <ButtonPrimary text="Buy!" type="submit" />
                </div>
            </div>
        </form>
    )
}

export default FormCreateOrder
