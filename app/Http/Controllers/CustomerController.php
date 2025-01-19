<?php

namespace App\Http\Controllers;

use App\Services\CustomerService;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        $customers = $this->customerService->getAllCustomers()->sortBy('name');
        return view('pages.customer.index', compact('customers'));
    }

    public function searchSort(Request $request) {}


    public function create()
    {
        return view('pages.customer.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $data['name'] = ucwords(strtolower($data['name']));

        $this->customerService->createCustomer($data);
        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $customer = $this->customerService->getCustomer($id);
        return view('pages.customer.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $this->customerService->updateCustomer($id, $data);
        return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $this->customerService->deleteCustomer($id);
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }
}
