<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Customer Data</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-espresso">
                    <div class="container mx-auto px-4 py-4">
                        <button onclick="openModal('{{ route('customer.create') }}')"
                            class="bg-espresso text-latte px-4 py-2 rounded hover:bg-caramel hover:text-espresso mb-6 inline-block">
                            Add New Customer
                        </button>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rounded-lg shadow-sm">
                                <thead class="bg-espresso">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Address</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-latte customerTableBody">
                                    {{-- @foreach ($customers as $customer)
                                        <tr class="">
                                            <td class="px-6 py-4 text-sm text-espresso">{{ $customer->name }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-espresso">{{ $customer->address }}
                                            </td>
                                            <td class="px-6 py-4 text-sm">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('customer.edit', $customer->id) }}"
                                                        class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                                    <form action="{{ route('customer.destroy', $customer->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
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
                url: "http://127.0.0.1:8000/api/customer",
                type: "GET",

                success: function(data) {
                    const customers = data.customers;
                    let customersTableBody = document.querySelector('.customerTableBody');
                    let rows = '';

                    customers.forEach(customer => {
                        rows += `
                                    <tr>
                                        <td class="px-6 py-4 text-md text-espresso">${customer.name}</td>
                                        <td class="px-6 py-4 text-md text-espresso">${customer.address}</td>
                                        <td class="px-6 py-4 text-sm">
                                            <div class="flex space-x-2">
                                                <!-- Edit Button -->
                                                <button onclick="openModal('/customer/${customer.id}/edit')"
                                                    class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">
                                                    Edit
                                                </button>
                                                <!-- Delete Button -->
                                                <button type="button" onclick="deleteCustomer(${customer.id})"
                                                    class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>

                                            </div>
                                        </td>
                                    </tr>
                                `;
                    });
                    customersTableBody.innerHTML = rows;
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
            const form = document.getElementById('createCustomerForm');
            const formData = new FormData(form);

            axios.post('http://127.0.0.1:8000/api/customer', formData, {
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
            const form = document.getElementById('editCustomerForm');
            const formData = new FormData(form);
            const id = form.getAttribute('data-cust-id');

            Swal.fire({
                title: 'Are you sure you want to update this customer?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, update it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post(`http://127.0.0.1:8000/api/customer/${id}`, formData, {
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

        function deleteCustomer(id) {
            Swal.fire({
                title: 'Are you sure you want to delete this customer?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`http://127.0.0.1:8000/api/customer/${id}`, {
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
