import React from 'react'
import ProductList from '../../components/ProductList/ProductList'
import { ProductProvider } from '../../contexts/product-context'

const HomeView = () => {
    return (
        <div className="py-4">
            <h1 className="text-2xl">Products</h1>
            <ProductProvider>
                <ProductList />
            </ProductProvider>
        </div>
    )
}

export default HomeView
