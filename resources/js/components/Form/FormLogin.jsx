import React, { useEffect, useState } from 'react'
import { useAuth } from '../../contexts/auth-context';
import Input from '../Input/Input';
import ButtonPrimary from '../Button/ButtonPrimary'

const FormLogin = () => {
    const { state, actions } = useAuth();

    const [fields, setFields] = useState({
        email: '',
        password: '',
    })

    const handleSubmit = (e) => {
        e.preventDefault();
        actions.login(fields);
    }

    const handleChange = (e) => {
        setFields(state => ({
            ...state,
            [e.target.name]: e.target.value
        }))
    }

    useEffect(() => {
        return () => {
            actions.resetErrors();
        }
    }, [])

    return (
        <form onSubmit={handleSubmit} >
            <div className="mb-4">
                <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="email">
                    Email
                </label>
                <Input onChange={handleChange} name="email" id="email" type="text" placeholder="email" className={`${state.errors.email.trim() !== '' && 'border-red-500'}`} />
                {state.errors.email.trim() !== '' && (<p className="text-red-500 text-xs italic">{state.errors.email}</p>)}
            </div>
            <div className="mb-6">
                <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="password">
                    Password
                </label>
                <Input onChange={handleChange} name="password" className={`${state.errors.password.trim() !== '' && 'border-red-500 '}shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline`} id="password" type="password" placeholder="******************" />
                {state.errors.password.trim() !== '' && (<p className="text-red-500 text-xs italic">{state.errors.password}.</p>)}
            </div>
            <div className="text-right">
                <ButtonPrimary type="submit" text="Sign In" />
            </div>
        </form>
    )
}

export default FormLogin
