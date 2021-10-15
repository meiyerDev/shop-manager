import React, { useEffect, useState } from 'react'
import { useHistory, useParams } from 'react-router-dom';
import ButtonPrimary from '../../components/Button/ButtonPrimary';
import { useOrder } from '../../contexts/order-context';
import { getRouteToStatusOrder } from '../../utils/order-status';
import useQuery from '../../utils/use-query';

const PendingOrder = () => {
    const { orderId } = useParams();
    const { state: { order }, actions } = useOrder();
    const history = useHistory();
    const reason = useQuery('reason');

    const [text, setText] = useState('')

    useEffect(() => {
        actions.getById(orderId);
    }, [orderId])

    useEffect(() => {
        if (order && order.status === 'PAYED') history.push(getRouteToStatusOrder(order))
    }, [order]);

    useEffect(() => {
        if (reason === 'validating') setText('We are validating your payment');
        if (reason === 'failed') setText('Your payment failed, complete your purchase');
        setText('Your payment is pending, if you did not complete the purchase');
    }, [reason])

    const handleRetryCheckout = () => {
        if (reason === 'pending') {
            actions.retryLatestPlacetoPay(orderId)
            return;
        };
        actions.checkoutPlacetoPay(orderId);
    }

    if (!order || order.status === 'PAYED') return <div>loading..</div>

    return (
        <div className="flex justify-center">
            <div className="w-2/3 bg-white space-y-3 shadow-md rounded py-5 flex justify-center items-center flex-col text-center">
                <h3 className="text-2xl mb-2">{text}<br /><span className="text-base"> for the order no. {order.code}</span></h3>
                {reason !== 'validating' ? (
                    <ButtonPrimary text="Retry" className="mb-0" onClick={handleRetryCheckout} />
                ) : (
                    <ButtonPrimary text="Go to Home" className="mb-0" onClick={() => history.push('/')} />
                )}
            </div>
        </div>
    )
}

export default PendingOrder
