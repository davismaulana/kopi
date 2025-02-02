import { useState } from 'react';
import authService from '../api/authService';

const useAuth = () => {
    const [user, setUser] = useState(null);
    const [token, setToken] = useState(localStorage.getItem('token'));

    const login = async (email, password) => {
        try {
            const {user,token} = await authService.login(email,password);
            localStorage.setItem('token',token);
            setUser(user);
            setToken(token);
        } catch (error) {
            console.error('Login failed:',error)
            throw error;
        }
    };

    const logout = async () => {
        try {
            await authService.logout(token);
            localStorage.removeItem('token');
            setUser(null);
            setToken(null);
        } catch (error) {
            console.error('Logout failed:',error);
            throw error;
        }
    };

    const fetchUser = async () => {
        try {
            const user = await authService.getUser(token);
            setUser(user);
        } catch (error) {
            console.error('Failed to fetch user:',error);
            throw error;
        }
    };

    return {user,token,login,fetchUser,logout};

};

export default useAuth;