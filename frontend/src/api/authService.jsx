import axios from "axios";

const API_URL = import.meta.env.VITE_API_URL || 'http://127.0.0.1:8000/api';

const login = async (email, password) => {
    const response = await axios.post(`${API_URL}/login`, {email, password});
    return response.data;
};

const logout = async (token) => {
    const response = await axios.post(`${API_URL}/logout`, null, {
        headers: {
            Authorization: `Bearer ${token}`,
        }
    });
    return response.data;
};

const getUser = async (token) => {
    const response = await axios.get(`${API_URL}/user`, {
        headers: {
            Authorization: `Bearer ${token}`
        }
    });
    return response.data;
};

export default {
    login,
    logout,
    getUser
}