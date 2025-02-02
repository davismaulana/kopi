import { useNavigate } from "react-router-dom"

const Sidebar = () => {
    const navigate = useNavigate();

    const handleLogout = () => {
        localStorage.removeItem('token');
        navigate('/login');
    };

    return (
        <aside className="w-64 bg-latte text-espresso h-screen fixed flex flex-col border-r border-espresso">
            {/* Header */}
            <div className="p-4">
                <h1 className="text-2xl font-bold text-center">
                    <i className="fa-regular fa-user"></i> User Name
                </h1>
            </div>

            {/* Navigation Links */}
            <nav className="mt-6 flex-1">
                <ul className="ml-3">
                    <li className="px-3 py-3 mr-5 hover:bg-caramel hover:text-espresso rounded-xl mb-1">
                        <Link to="/dashboard" className="block">
                            <div className="grid grid-cols-5">
                                <h1 className="text-md">
                                    <i className="fas fa-tachometer-alt mr-5"></i>
                                </h1>
                                <h1 className="text-md">Dashboard</h1>
                            </div>
                        </Link>
                    </li>
                    {/* Add other navigation links here */}
                </ul>
            </nav>

            {/* Logout Button */}
            <div className="p-4 mt-auto text-right">
                <button
                    onClick={handleLogout}
                    className="px-4 py-2 hover:bg-red-600 hover:text-latte rounded"
                >
                    <i className="fas fa-sign-out-alt mr-2"></i>Logout
                </button>
            </div>
        </aside>
    );
};

export default Sidebar;