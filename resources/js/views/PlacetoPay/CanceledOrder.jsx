import React, { useEffect } from 'react'
import { Link, useHistory, useParams } from 'react-router-dom';
import ButtonPrimary from '../../components/Button/ButtonPrimary';
import { useOrder } from '../../contexts/order-context';
import { getRouteToStatusOrder } from '../../utils/order-status';

const CanceledOrder = () => {
    const { orderId } = useParams();
    const { state: { order }, actions } = useOrder();
    const history = useHistory();

    useEffect(() => {
        actions.getById(orderId);
    }, [orderId])

    useEffect(() => {
        if (order && order.status !== 'REJECTED') history.push(getRouteToStatusOrder(order))
    }, [order]);

    const handleRetryCheckout = () => {
        actions.checkoutPlacetoPay(orderId);
    }

    if (!order || order.status !== 'REJECTED') return <div>loading..</div>

    return (
        <div className="flex justify-center">
            <div className="w-1/2 bg-white space-y-3 shadow-md rounded py-5 flex justify-center items-center flex-col text-center">
                <h3 className="text-2xl mb-2">You have rejected the purchase <br /><span className="text-base">of order no. {order.code}</span></h3>
                <ButtonPrimary text="Retry" className="mb-0" onClick={handleRetryCheckout} />
                <p className="text-gray-500">or <Link to="/">go to Home</Link></p>
            </div>
        </div>
    )
}

export default CanceledOrder
