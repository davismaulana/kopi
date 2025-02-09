<!-- resources/views/user/index.blade.php -->
<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Users</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Admin -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-user-tie mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Admin Total</p>
                            <p class="text-3xl font-semibold" id="countAdmin"></p>
                        </div>
                    </div>
                </div>

                <!-- Total Cashier -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fa-solid fa-cash-register mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">Cashier Total</p>
                            <p class="text-3xl font-semibold" id="countCashier"></p>
                        </div>
                    </div>
                </div>

                <!-- Total Users -->
                <div
                    class="bg-latte hover:bg-espresso text-espresso hover:text-latte overflow-hidden shadow-md sm:rounded-lg p-6">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <i class="fas fa-users mr-2 fa-2x"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-xl font-medium">User Total</p>
                            <p class="text-3xl font-semibold" id="countUser"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-latte overflow-hidden shadow-md rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-4">
                        <button onclick="openModal('{{ route('user.create') }}')"
                            class="bg-espresso text-white px-4 py-2 rounded hover:bg-caramel hover:text-espresso mb-6 inline-block">
                            Add New User
                        </button>
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-gray-700 rounded-lg shadow-sm" id="usersTable">
                                <thead class="bg-espresso">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-sm text-white uppercase tracking-wider">Name
                                        </th>
                                        <th class="px-6 py-3 text-left text-sm text-white uppercase tracking-wider">
                                            Email</th>
                                        <th class="px-6 py-3 text-left text-sm text-white uppercase tracking-wider">
                                            Level</th>
                                        <th class="px-6 py-3 text-left text-sm text-white uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="userTableBody divide-y divide-latte bg-latte">
                                    <!-- Rows will be dynamically inserted here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Container -->
    <div id="modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-latte p-6 rounded-lg shadow-md w-full max-w-lg">
            <div id="modal-content"></div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "http://127.0.0.1:8000/api/user",
                type: "GET",

                success: function(data) {
                    document.getElementById("countUser").innerText = data.countUser;
                    document.getElementById("countAdmin").innerText = data.countAdmin;
                    document.getElementById("countCashier").innerText = data.countCashier;

                    const users = data.users;
                    let usersTableBody = document.querySelector('.userTableBody');
                    let rows = '';

                    users.forEach(user => {
                        rows += `
                                    <tr>
                                        <td class="px-6 py-4 text-md text-espresso">${user.name}</td>
                                        <td class="px-6 py-4 text-md text-espresso">${user.email}</td>
                                        <td class="px-6 py-4 text-md text-espresso">${user.level}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="flex space-x-2">
                                                <!-- Edit Button -->
                                                <button onclick="openModal('/user/${user.id}/edit')"
                                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                                    Edit
                                                </button>
                                                <!-- Delete Button -->
                                                <button type="button" onclick="deleteUser(${user.id})"
                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>

                                            </div>
                                        </td>
                                    </tr>
                                `;
                    });
                    usersTableBody.innerHTML = rows;
                }
            })

        })

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

        function submitForm() {
            const form = document.getElementById('createUserForm');
            const formData = new FormData(form);

            axios.post('http://127.0.0.1:8000/api/user', formData, {
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
            const form = document.getElementById('editUserForm');
            const formData = new FormData(form);
            const userId = form.getAttribute('data-user-id');

            Swal.fire({
                title: 'Are you sure you want to update this user?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(`http://127.0.0.1:8000/api/user/${userId}`, formData, {
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
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

        function deleteUser(userId) {
            Swal.fire({
                title: 'Are you sure you want to delete this user?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`http://127.0.0.1:8000/api/user/${userId}`, {
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

</x-app-layout>
