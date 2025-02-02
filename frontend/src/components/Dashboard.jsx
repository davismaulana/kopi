import axios from "axios";
import { Chart, registerables } from "chart.js";
import { Bar, Line } from 'react-chartjs-2';
import { useEffect, useState } from "react";

Chart.register(...registerables);

const Dashboard = () => {
    const [data,setData] = useState({
        totalCustomers:0,
        totalMenus:0,
        totalPayments:0,
        totalUsers:0,
        salesData:[],
        topMenusData:[]
    });

    useEffect(() => {
        axios.get('http://localhost:8000/api/dashboard').then(response => {
            setData(response.data)
        })
        .catch(error => {
            console.error();
            'Error fetching dashboard data', error
        });
    }, []);

    return (
        <div className="min-h-screen bg-latte flex">
            {/* sidebar */}

            {/* main */}
            <div className="ml-64 flex-1 p-6">
                <h1 className="text-3xl font-bold mb-8 text-center text-espresso">Dashboard</h1>

                {/* grid */}
                <div className="grid grid-cols-4 gap-6 mb-8">
                    {/* total cust */}
                    <div className="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md rounded-lg p-6">
                        <div className="flex item-center">
                            <div className="flex-shrink-0">
                                <i className="fas fa-user-friends mr-2 fa-2x"></i>
                            </div>
                            <div className="ml-4">
                                <p className="text-xl font-medium">Total Customer</p>
                                <p className="text-3xl font-semibold">{data.totalCustomers}</p>
                            </div>
                        </div>
                    </div>

                    {/* Total Menus Card */}
                    <div className="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <i className="fas fa-utensils mr-2 fa-2x"></i>
                            </div>
                            <div className="ml-4">
                                <p className="text-xl font-medium">Total Menus</p>
                                <p className="text-3xl font-semibold">{data.totalMenus}</p>
                            </div>
                        </div>
                    </div>

                    {/* Total Payments Card */}
                    <div className="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <i className="fas fa-receipt mr-2 fa-2x"></i>
                            </div>
                            <div className="ml-4">
                                <p className="text-xl font-medium">Total Payments</p>
                                <p className="text-3xl font-semibold">{data.totalPayments}</p>
                            </div>
                        </div>
                    </div>

                    {/* Total Users Card */}
                    <div className="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                        <div className="flex items-center">
                            <div className="flex-shrink-0">
                                <i className="fas fa-users mr-2 fa-2x"></i>
                            </div>
                            <div className="ml-4">
                                <p className="text-xl font-medium">Total Users</p>
                                <p className="text-3xl font-semibold">{data.totalUsers}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Graphs Section */}
                <div className="bg-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Sales Over Time</h3>
                    <Line
                        data={{
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                            datasets: [
                                {
                                    label: 'Total Sales',
                                    data: data.salesData,
                                    borderColor: 'rgba(99, 102, 241, 1)',
                                    borderWidth: 2,
                                    backgroundColor: 'rgba(99, 102, 241, 0.2)',
                                    fill: true,
                                    tension: 0.4,
                                },
                            ],
                        }}
                    />
                </div>

                <div className="bg-latte overflow-hidden shadow-md sm:rounded-lg p-6 mt-4">
                    <h3 className="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Top Selling Menus</h3>
                    <Bar
                        data={{
                            labels: Object.keys(data.topMenusData),
                            datasets: [
                                {
                                    label: 'Quantity Sold',
                                    data: Object.values(data.topMenusData),
                                    backgroundColor: 'rgba(0, 245, 71, 0.6)',
                                    borderColor: 'rgba(0, 245, 71, 1)',
                                    borderWidth: 1,
                                },
                            ],
                        }}
                    />
                </div>
            </div>
        </div>
    );
};

export default Dashboard;