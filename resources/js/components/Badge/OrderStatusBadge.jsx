import React from 'react'
import { ORDER_STATUS_COLOR, ORDER_STATUS_NAMES } from '../../utils/order-status'

const OrderStatusBadge = ({ orderStatus }) => {
    return (
        <span className={`py-1 px-3 m-1 rounded text-gray-50 ${ORDER_STATUS_COLOR[orderStatus]}`}>
            {ORDER_STATUS_NAMES[orderStatus]}
        </span>
    )
}

export default OrderStatusBadge
