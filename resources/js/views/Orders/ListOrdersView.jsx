import React, { useEffect } from 'react'
import { useHistory } from 'react-router-dom/cjs/react-router-dom.min';
import ButtonPrimary from '../../components/Button/ButtonPrimary';
import { useOrder } from '../../contexts/order-context'
import { ORDER_STATUS_NAMES } from '../../utils/order-status';

const ListOrdersView = () => {
    const { state, actions } = useOrder();

    const history = useHistory();

    useEffect(() => {
        actions.getByAuth();
    }, [])

    return (
        <div className="py-4 px-3 mt-4">
            <table className="table-fixed border-collapse border w-full text-left">
                <thead>
                    <tr>
                        <th className="border p-3 w-2/5">Code</th>
                        <th className="border p-3 w-1/6">Customer name</th>
                        <th className="border p-3 w-1/6">Status</th>
                        <th className="border p-3 w-1/6">Amount</th>
                        <th className="border p-3 w-1/6">Updated At</th>
                        <th className="border p-3 w-1/6"></th>
                    </tr>
                </thead>
                <tbody>
                    {state.orders.map((order, index) => (
                        <tr key={`list-order-client-item_${order.id}`} className={`${index % 2 === 0 && 'bg-gray-100'} hover:bg-gray-200`}>
                            <td className="p-2 border">{order.code}</td>
                            <td className="p-2 border">{order.customer_name}</td>
                            <td className="p-2 border">{ORDER_STATUS_NAMES[order.status]}</td>
                            <td className="p-2 border">{order.amount_total}</td>
                            <td className="p-2 border">{order.updated_at}</td>
                            <td className="p-2 border text-center"><ButtonPrimary onClick={() => history.push(`/orders/${order.id}`)} text="Details" /></td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    )
}

export default ListOrdersView
