import React from 'react'
import Navbar from '../Navbar/Navbar'

const Layout = ({ children }) => {
    return (
        <>
            <Navbar />
            <div className="max-w-6xl mx-auto px-4 pt-4">
                {children}
            </div>
        </>
    )
}

export default Layout
