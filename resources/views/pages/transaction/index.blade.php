<x-app-layout>
    <h1 class="text-3xl font-bold mb-8 text-center text-espresso">Transaction Log</h1>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-latte overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="container mx-auto px-4 py-4">
                        <a href="{{ route('transaction.create') }}"
                            class="bg-espresso text-white px-4 py-2 rounded hover:bg-caramel hover:text-espresso mb-6 inline-block">
                            Add New Transaction
                        </a>
                        <div class="overflow-x-auto">
                            <table class="min-w-full rounded-lg shadow-sm">
                                <thead class="bg-espresso">
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Chasier Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Customer Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Menu Name</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Quantity</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Total Price</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                            Date</th>
                                        @can('admin')
                                            <th
                                                class="px-6 py-3 text-left text-xs font-medium text-white uppercase tracking-wider">
                                                Actions</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-latte bg-latte transactionTableBody">
                                    {{-- @foreach ($transactions as $trans)
                                        <tr class="">
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                {{ $trans->cashier->name }}</td>
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                {{ $trans->customer->name }}</td>
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                {{ $trans->menu->name }}</td>
                                            <td class="px-6 py-4 text-sm text-espresso">{{ $trans->count }}
                                            </td>
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                Rp.{{ number_format($trans->total_price, 2, ',', '.') }}</td>
                                            <td class="px-6 py-4 text-sm text-espresso">
                                                {{ $trans->created_at }}</td>

                                            @can('admin')
                                                <td class="px-6 py-4 text-sm">
                                                    <div class="flex space-x-2">
                                                        <a href="{{ route('transaction.edit', $trans->id) }}"
                                                            class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600">Edit</a>
                                                        <form action="{{ route('transaction.destroy', $trans->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @endcan
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

    <script>
        $(document).ready(function() {
            $.ajax({
                url: "http://127.0.0.1:8000/api/transaction",
                type: "GET",

                success: function(data) {
                    const transactions = data.transactions;
                    let transactionsTableBody = document.querySelector('.transactionTableBody');
                    let rows = '';

                    transactions.forEach(trans => {
                        const date = new Date(trans.created_at);

                        // Format the date to "MM/DD/YYYY"
                        const formattedDate =
                            `${date.getMonth() + 1}/${date.getDate()}/${date.getFullYear()}`;

                        // Format the time to "HH:MM AM/PM"
                        let hours = date.getHours();
                        let minutes = date.getMinutes();
                        const ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12;
                        hours = hours ? hours : 12; // 12 hour format
                        minutes = minutes < 10 ? '0' + minutes : minutes;

                        const formattedTime = `${hours}:${minutes} ${ampm}`;

                        rows += `
                                <tr>
                                    <td class="px-6 py-4 text-sm text-espresso">
                                        ${ trans.cashier.name }</td>
                                    <td class="px-6 py-4 text-sm text-espresso">
                                        ${ trans.customer.name }</td>
                                    <td class="px-6 py-4 text-sm text-espresso">
                                        ${ trans.menu.name }</td>
                                    <td class="px-6 py-4 text-sm text-espresso">
                                        ${ trans.count }
                                    </td>
                                    <td class="px-6 py-4 text-sm text-espresso">
                                        Rp. ${ trans.total_price.toLocaleString('id-ID') }
                                    <td class="px-6 py-4 text-sm text-espresso">
                                        ${ formattedDate } ${ formattedTime }</td>

                                        @can('admin')
                                            <td class="px-6 py-4 text-sm">
                                                <div class="flex space-x-2">
                                                    <button type="button" onclick="deleteTransaction(${trans.id})"
                                                        class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">Delete</button>

                                                </td>
                                            @endcan
                                        </tr>

                            `;
                    });
                    transactionsTableBody.innerHTML = rows;
                }
            })
        })

        function deleteTransaction(id) {
            Swal.fire({
                title: 'Are you sure you want to delete this transaction?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`http://127.0.0.1:8000/api/transaction/${id}`, {
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
