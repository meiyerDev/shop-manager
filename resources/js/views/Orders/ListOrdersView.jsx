import React, { useEffect } from 'react'
import { useOrder } from '../../contexts/order-context'

const ListOrdersView = () => {
    const { state, actions } = useOrder();

    useEffect(() => {
        actions.getByAuth();
    }, [])

    return (
        <div className="py-4 px-3 mt-4">
            <table className="table-fixed border-collapse border w-full">
                <thead>
                    <tr>
                        <th className="p-3 w-1/5">Code</th>
                        <th className="p-3 w-1/5">Customer name</th>
                        <th className="p-3 w-1/5">Status</th>
                        <th className="p-3 w-1/5">Amount</th>
                        <th className="p-3 w-1/5">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    {state.orders.map(order => (
                        <tr key={`list-order-client-item_${order.id}`}>
                            <td>{order.code}</td>
                            <td>{order.customer_name}</td>
                            <td>{order.status}</td>
                            <td>{order.amount_total}</td>
                            <td>{order.updated_at}</td>
                        </tr>
                    ))}
                </tbody>
            </table>
        </div>
    )
}

export default ListOrdersView
