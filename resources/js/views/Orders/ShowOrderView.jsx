import React, { useEffect } from 'react'
import { useParams } from 'react-router-dom';
import OrderStatusBadge from '../../components/Badge/OrderStatusBadge';
import ButtonPrimary from '../../components/Button/ButtonPrimary';
import { useOrder } from '../../contexts/order-context';
import { ORDER_STATUS_BUTTON_CHECKOUT } from '../../utils/order-status';

const ShowOrderView = () => {
    const { orderId } = useParams();
    const { state: { order }, actions } = useOrder();

    useEffect(() => {
        actions.getById(orderId);
    }, [orderId])

    const handleCheckout = () => {
        actions.checkoutPlacetoPay(orderId);
    }

    if (!order) return <div>loading..</div>

    return (
        <div className="w-full my-3">
            <div className="flex justify-center">
                <div className="bg-white shadow-md rounded w-1/3 p-6">
                    <div className="text-center mb-4">
                        <h2 className="text-3xl my-2 font-semibold">Order details</h2>
                        <div className="text-sm">{order.code}</div>
                        <span className="text-sm">{order.created_at} | Total: {order.amount_total} USD</span>
                        <div className="mt-1">
                            <OrderStatusBadge orderStatus={order.status} />
                        </div>
                    </div>

                    {/* CUSTOMER */}
                    <div className="w-1/4 font-medium">Customer</div>
                    <div className="w-full border mb-2"></div>
                    <div className="text-left mb-2">
                        <p><span>Name:</span> {order.customer_name}</p>
                        <p><span>Email:</span> {order.customer_email}</p>
                        <p><span>Phone:</span> {order.customer_mobile}</p>
                    </div>


                    {/* PRODUCTS */}
                    <div className="w-1/4 font-medium">Products</div>
                    <div className="w-full border mb-2"></div>
                    {order.products.map(product => (
                        <div key={`order_product_${product.id}`} className="flex justify-between w-full bg-gray-100 text-gray-500 rounded py-1 px-4">
                            <div>{product.name}</div>
                            <div>x1</div>
                            <div>{product.price} USD</div>
                        </div>
                    ))}
                    <div className="w-full border mt-2"></div>
                    <div className="font-medium text-right mt-1">Total: {order.amount_total} USD</div>

                    {ORDER_STATUS_BUTTON_CHECKOUT[order.status] && <ButtonPrimary text={ORDER_STATUS_BUTTON_CHECKOUT[order.status]} className="w-full mt-3" onClick={handleCheckout} />}
                </div>
            </div>
        </div>
    )
}

export default ShowOrderView
