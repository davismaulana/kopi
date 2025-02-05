<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
        return response()->json([
            'data' => $customers
        ],200);
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

        $customer = $this->customerService->createCustomer($data);
        return response()->json([
            'message' => 'Customer created',
            'data' => $customer
        ]);
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

        $customer = $this->customerService->updateCustomer($id, $data);
        return response()->json([
            'message' => 'Update successfull',
            'data' => $customer
        ],200);
    }

    public function destroy($id)
    {
        $this->customerService->deleteCustomer($id);
        return response()->json([
            'message' => 'Delete successfully',
        ]);
    }
}
