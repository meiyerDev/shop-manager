import React, { useState } from 'react'
import ButtonPrimary from '../Button/ButtonPrimary'
import FormLogin from '../Form/FormLogin'
import FormSignup from '../Form/FormSignup'
import Modal from '../Modal/Modal'

const ModalAuth = () => {
    const [isOpen, setIsOpen] = useState(false)
    const [tabActive, setTabActive] = useState(0)

    const getClassNameByTabActive = (tab) => (tab === tabActive) ? 'text-green-500 border-b-2 font-medium border-green-500' : '';

    return (
        <>
            <ButtonPrimary text="Sign in" onClick={() => setIsOpen(true)} />
            <Modal
                isOpen={isOpen}
                closeModal={() => setIsOpen(false)}
                modalTitle={""}
                contentExtraClass="max-w-md"
                renderContent={() => (
                    <>
                        <div className="w-full flex justify-center">
                            <nav className="flex flex-col sm:flex-row">
                                <button
                                    type="button"
                                    className={`text-gray-600 py-2 px-6 block hover:text-green-500 focus:outline-none ${getClassNameByTabActive(0)}`}
                                    onClick={() => setTabActive(0)}
                                >
                                    Login
                                </button>
                                <button
                                    type="button"
                                    className={`text-gray-600 py-2 px-6 block hover:text-green-500 focus:outline-none ${getClassNameByTabActive(1)}`}
                                    onClick={() => setTabActive(1)}
                                >
                                    Signup
                                </button>
                            </nav>
                        </div>
                        {tabActive === 0 ? <FormLogin /> : <FormSignup />}
                    </>
                )}
            />
        </>
    )
}

export default ModalAuth
