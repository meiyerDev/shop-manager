import React from 'react'
import { useAuth } from '../../contexts/auth-context';
import ButtonPrimary from './ButtonPrimary';

const ButtonLogout = () => {
    const { state, actions } = useAuth();

    const handlelogout = (e) => {
        actions.logout();
    }

    return (
        <ButtonPrimary text="logout" onClick={handlelogout} />
    )
}

export default ButtonLogout
