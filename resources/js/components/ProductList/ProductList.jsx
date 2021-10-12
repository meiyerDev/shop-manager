import React, { useEffect } from 'react'
import { useProduct } from '../../contexts/product-context'
import ProductListItem from './ProductListItem';

const ProductList = () => {
    const { state, actions } = useProduct();

    useEffect(() => {
        actions.fetchProducts();
    }, [])

    return (
        <div className="py-1">

            {state.products.map(
                product => <ProductListItem key={product.id} product={product} />
            )}

        </div>
    )
}

export default ProductList
