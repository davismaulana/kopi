
document.addEventListener("DOMContentLoaded", function () {
    fetch("http://127.0.0.1:8000/api/dashboard") // Ganti dengan route API yang benar
        .then(response => response.json())
        .then(data => {
            document.getElementById("totalCustomers").innerText = data.totalCustomers;
            document.getElementById("totalMenus").innerText = data.totalMenus;
            document.getElementById("totalPayments").innerText = data.totalPayments;
            document.getElementById("totalUsers").innerText = data.totalUsers;

            updateCharts(data.topSales, data.topMenus); // Memperbarui grafik
        })
        .catch(error => console.error("Error fetching data:", error));
});

function updateCharts(topSales, topMenus) {
    // Perbarui chart Sales Over Time
    salesChart.data.datasets[0].data = Object.values(topSales);
    salesChart.update();

    // Perbarui chart Top Selling Menus
    topMenusChart.data.labels = Object.keys(topMenus);
    topMenusChart.data.datasets[0].data = Object.values(topMenus);
    topMenusChart.update();
}

