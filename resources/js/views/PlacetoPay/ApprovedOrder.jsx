import React, { useEffect } from 'react'
import { useHistory, useParams } from 'react-router-dom';
import ButtonPrimary from '../../components/Button/ButtonPrimary';
import { useOrder } from '../../contexts/order-context';
import { getRouteToStatusOrder } from '../../utils/order-status';

const ApprovedOrder = () => {
    const { orderId } = useParams();
    const { state: { order }, actions } = useOrder();
    const history = useHistory();

    useEffect(() => {
        actions.getById(orderId);
    }, [orderId])

    useEffect(() => {
        if (order && order.status !== 'PAYED') history.push(getRouteToStatusOrder(order))
    }, [order]);

    if (!order || order.status !== 'PAYED') return <div>loading..</div>

    return (
        <div className="flex justify-center">
            <div className="w-1/2 bg-white space-y-3 shadow-md rounded py-5 flex justify-center items-center flex-col text-center">
                <h3 className="text-2xl mb-2">You have successfully paid <br /><span className="text-base">the order no. {order.code}</span></h3>
                <ButtonPrimary text="Go to Home" className="mb-0" onClick={() => history.push('/')} />
            </div>
        </div>
    )
}

export default ApprovedOrder
