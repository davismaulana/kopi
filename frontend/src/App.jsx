import React from 'react';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import Login from './components/Login';
import Dashboard from './components/Dashboard';

const PrivateRoute = ({ element: Element,...rest}) => {
    const isAuthenticate = !!localStorage.getItem('token');

    return isAuthenticate ? (
        <Element {...rest} />
    ) : (
        <Navigate to="/login" replace />
    );
};

function App() {
    return (
        <div className="App">
            <Router>
                <Routes>
                    <Route path="/login" element={<Login />} />
                    <Route path="/dashboard" element={<PrivateRoute element={Dashboard} />} />
                    <Route path="/" element={<Navigate to="/dashboard" replace />} />
                </Routes>
            </Router>
        </div>
    );
}

export default App;