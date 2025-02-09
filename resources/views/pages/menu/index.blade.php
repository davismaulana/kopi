<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Menu Data</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Food -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-burger mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Food Total</p>
                            <p class="text-3xl font-semibold" id="countFood"></p>
                        </div>
                    </div>
                </div>

                <!-- Total Drink -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-wine-glass mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Beverage Total</p>
                            <p class="text-3xl font-semibold" id="countDrink"></p>
                        </div>
                    </div>
                </div>

                <!-- Total Menu -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Menu Total</p>
                            <p class="text-3xl font-semibold" id="countMenu"></p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-4">
                        <button onclick="openModal('{{ route('menu.create') }}')"
                            class="bg-espresso text-white px-4 py-2 rounded hover:bg-caramel hover:text-espresso mb-6 inline-block">
                            Add New Menu
                        </button>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rounded-lg shadow-sm">
                                <thead class="bg-espresso">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Image</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Price</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Stock</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Category</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-latte bg-latte menuTableBody">
                                    <!-- Rows will be dynamically inserted here -->
                                </tbody>
                            </table>

                            <!-- Modal (Hidden by default) -->
                            <div id="modal"
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                                <div class="bg-latte p-6 rounded-lg shadow-md w-full max-w-lg">
                                    <div id="modal-content"></div>
                                </div>
                            </div>

                            <!-- Modal View (Hidden by default) -->
                            <div id="modalView"
                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
                                <div class="bg-latte text-espresso p-8 rounded-lg shadow-lg max-w-lg w-full">
                                    <div class="mb-4">
                                        <img id="menuImage" alt="Menu Image"
                                            class="w-80 h-80 object-cover rounded-lg mx-auto mb-4">
                                    </div>
                                    <h1 class="text-xl font-bold mb-4">Menu Details</h1>
                                    <h3><strong>Name:</strong> <span id="menuName"></span></h3>
                                    <h3><strong>Price:</strong> Rp. <span id="menuPrice"></span></h3>
                                    <h3><strong>Stock:</strong> <span id="menuStock"></span></h3>
                                    <h3><strong>Category:</strong> <span id="menuCategory"></span></h3>
                                    <button onclick="closeModalView()"
                                        class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 mt-4">Close</button>
                                </div>
                            </div>

                            <script>
                                function openModal(url) {
                                    fetch(url)
                                        .then(response => response.text())
                                        .then(html => {
                                            document.getElementById('modal-content').innerHTML = html;
                                            document.getElementById('modal').classList.remove('hidden');
                                        });
                                }

                                // Close Modal
                                function closeModal() {
                                    document.getElementById('modal').classList.add('hidden');
                                }

                                function openModalView(menuId) {
                                    fetch(`/api/menu/${menuId}`)
                                        .then(response => response.json())
                                        .then(menu => {
                                            document.getElementById('menuImage').src = menu.image ? `/storage/${menu.image}` :
                                                'https://via.placeholder.com/150';
                                            document.getElementById('menuName').innerText = menu.name;
                                            document.getElementById('menuPrice').innerText = parseFloat(menu.price).toLocaleString('id-ID', {
                                                minimumFractionDigits: 2
                                            });
                                            document.getElementById('menuStock').innerText = menu.stock;
                                            document.getElementById('menuCategory').innerText = menu.category;

                                            document.getElementById('modalView').classList.remove('hidden');
                                        })
                                        .catch(error => console.log('Error fetching  menu details', error));
                                }

                                function closeModalView() {
                                    document.getElementById('modalView').classList.add('hidden');
                                }


                                $(document).ready(function() {
                                    $.ajax({
                                        url: "http://127.0.0.1:8000/api/menu",
                                        type: "GET",

                                        success: function(data) {
                                            document.getElementById("countMenu").innerText = data.countMenu;
                                            document.getElementById("countFood").innerText = data.countFood;
                                            document.getElementById("countDrink").innerText = data.countDrink;

                                            const menus = data.menus;
                                            let menusTableBody = document.querySelector('.menuTableBody');
                                            let rows = '';

                                            menus.forEach(menu => {
                                                let imageTag = menu.image ?
                                                    `<img src="/storage/${menu.image}" alt="Image" width="50">` :
                                                    'No Image';

                                                rows += `
                                                    <tr>
                                                        <td class="px-6 py-4 text-sm text-espresso"> 
                                                            ${ imageTag }
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-espresso">${ menu.name }
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-espresso">${ menu.stock }
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-espresso">
                                                            Rp. ${ menu.price.toLocaleString('id-ID') }
                                                        </td>
                                                        <td class="px-6 py-4 text-sm text-espresso">${ menu.category }
                                                        </td>
                                                        <td class="px-6 py-4 text-sm">
                                                            <div class="flex space-x-2">
                                                                <button type="button" onclick="openModalView('${menu.id}')"
                                                                    class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">View</button>
                                                                <button type="button" onclick="openModal('/menu/${menu.id}/edit')"
                                                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</button>
                                                                <button type="button" onclick="deleteMenu(${menu.id})"
                                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                `;
                                            });
                                            menusTableBody.innerHTML = rows;
                                        }
                                    })
                                })

                                function submitForm() {
                                    const form = document.getElementById('createMenuForm');
                                    const formData = new FormData(form);

                                    axios.post('http://127.0.0.1:8000/api/menu', formData, {
                                            headers: {
                                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                                    'content')
                                            }
                                        })
                                        .then(response => {
                                            Swal.fire({
                                                title: 'Create data Successfully',
                                                icon: 'success',
                                                confirmButtonText: 'OK'

                                            }).then(function() {
                                                window.location.reload();
                                            });
                                        })
                                        .catch(error => {
                                            if (error.response) {
                                                const errors = error.response.data.errors;
                                                let errorMessage = '';
                                                for (const key in errors) {
                                                    errorMessage += `${key}: ${errors[key].join(', ')}\n`;
                                                }
                                                alert(errorMessage);
                                            } else {
                                                alert('An error occurred. Please try again later');
                                            }
                                        });
                                }

                                function updateForm() {
                                    const form = document.getElementById('editMenuForm');
                                    const formData = new FormData(form);
                                    const userId = form.getAttribute('data-menu-id');

                                    Swal.fire({
                                        title: 'Are you sure you want to update this menu?',
                                        text: "You won't be able to revert this!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Yes, update it!',
                                        cancelButtonText: 'Cancel',
                                        reverseButtons: true
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            axios.post(`http://127.0.0.1:8000/api/menu/${userId}`, formData, {
                                                    headers: {
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                                            .getAttribute(
                                                                'content'),
                                                        'Content-Type': 'multipart/form-data',
                                                    }
                                                })
                                                .then(response => {
                                                    Swal.fire({
                                                        title: 'Update data Successfully',
                                                        icon: 'success',
                                                        confirmButtonText: 'OK'

                                                    }).then(function() {
                                                        window.location.reload();
                                                    });
                                                })
                                                .catch(error => {
                                                    if (error.response) {
                                                        const errors = error.response.data.errors;
                                                        let errorMessage = '';
                                                        for (const key in errors) {
                                                            errorMessage += `${key}: ${errors[key].join(', ')}\n`;
                                                        }
                                                        alert(errorMessage);
                                                    } else {
                                                        alert('An error occurred. Please try again later');
                                                    }
                                                });
                                        } else {
                                            Swal.fire({
                                                title: 'Update cancelled',
                                                icon: 'info',
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    })
                                }

                                function deleteMenu(id) {
                                    Swal.fire({
                                        title: 'Are you sure you want to delete this menu?',
                                        text: "You won't be able to revert this!",
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonText: 'Yes, delete it!',
                                        cancelButtonText: 'Cancel',
                                        reverseButtons: true
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            axios.delete(`http://127.0.0.1:8000/api/menu/${id}`, {
                                                    headers: {
                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                                            'content')
                                                    }
                                                })
                                                .then(response => {
                                                    Swal.fire({
                                                        title: 'Delete data Successfully',
                                                        icon: 'success',
                                                        confirmButtonText: 'OK'

                                                    }).then(function() {
                                                        window.location.reload();
                                                    });
                                                })
                                                .catch(error => {
                                                    if (error.response) {
                                                        const errors = error.response.data.errors;
                                                        let errorMessage = '';
                                                        for (const key in errors) {
                                                            errorMessage += `${key}: ${errors[key].join(', ')}\n`;
                                                        }
                                                        alert(errorMessage);
                                                    } else {
                                                        alert('An error occurred. Please try again later');
                                                    }
                                                })
                                        } else {
                                            Swal.fire({
                                                title: 'Delete cancelled',
                                                icon: 'info',
                                                confirmButtonText: 'OK'
                                            });
                                        }
                                    })
                                }
                            </script>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
