import React, { useEffect, useState } from 'react'
import { useAuth } from '../../contexts/auth-context';
import Input from '../Input/Input';
import ButtonPrimary from '../Button/ButtonPrimary'

const FormSignup = () => {
    const { state, actions } = useAuth();

    const [fields, setFields] = useState({
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
    })

    const handleSubmit = (e) => {
        e.preventDefault();
        actions.signup(fields);
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
                <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="name">
                    Name
                </label>
                <Input onChange={handleChange} value={fields.name} name="name" id="name" type="text" placeholder="Your name" className={`${state.errors.name.trim() !== '' && 'border-red-500'}`} />
                {state.errors.name.trim() !== '' && (<p className="text-red-500 text-xs italic">{state.errors.name}</p>)}
            </div>
            <div className="mb-4">
                <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="email">
                    Email
                </label>
                <Input onChange={handleChange} value={fields.email} name="email" id="email" type="email" placeholder="Your email address" className={`${state.errors.email.trim() !== '' && 'border-red-500'}`} />
                {state.errors.email.trim() !== '' && (<p className="text-red-500 text-xs italic">{state.errors.email}</p>)}
            </div>
            <div className="mb-4">
                <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="password">
                    Password
                </label>
                <Input onChange={handleChange} value={fields.password} name="password" className={`${state.errors.password.trim() !== '' && 'border-red-500 '}`} id="password" type="password" placeholder="******************" />
                {state.errors.password.trim() !== '' && (<p className="text-red-500 text-xs italic">{state.errors.password}.</p>)}
            </div>
            <div className="mb-6">
                <label className="block text-gray-700 text-sm font-bold mb-2" htmlFor="password_confirmation">
                    Confirm Password
                </label>
                <Input onChange={handleChange} value={fields.password_confirmation} name="password_confirmation" id="password_confirmation" type="password" placeholder="******************" />
            </div>
            <div className="text-right">
                <ButtonPrimary type="submit" text="Sign In" />
            </div>
        </form>
    )
}

export default FormSignup
