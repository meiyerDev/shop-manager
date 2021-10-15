export const ORDER_STATUS_NAMES = {
    CREATED: 'Pending',
    PAYED: 'Payed',
    REJECTED: 'Rejected',
}

export const ORDER_STATUS_COLOR = {
    CREATED: 'bg-yellow-500',
    PAYED: 'bg-green-500',
    REJECTED: 'bg-red-500',
}

export const ORDER_STATUS_BUTTON_CHECKOUT = {
    CREATED: 'Proceed checkout!',
    REJECTED: 'Retry checkout!'
}

export const getRouteToStatusOrder = (order) => {
    if (order.status === 'PAYED') return `/orders/${order.id}/placeto-pay/successful`;
    if (order.status === 'REJECTED') return `/orders/${order.id}/placeto-pay/canceled`;
    return `/orders/${order.id}`;
}