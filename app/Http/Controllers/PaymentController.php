<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function index()
    {
        $payments = $this->paymentService->getAllPayments()->sortByDesc('created_at');
        return view('pages.payment.index', compact('payments'));
    }

    public function searchSort(Request $request) {}


    // public function create()
    // {
    //     return view('pages.payment.create');
    // }

    // public function store(Request $request)
    // {
    //     $data = $request->validate([
    //         'name' => 'required',
    //         'address' => 'required',
    //     ]);

    //     $data['name'] = ucwords(strtolower($data['name']));

    //     $this->customerService->createCustomer($data);
    //     return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    // }

    public function edit($id)
    {
        $payment = $this->paymentService->getPayment($id);
        return view('pages.payment.edit', compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'payment_method' => 'required|string|in:Cash,Credit Card,Online Payment',
            'payment_status' => 'required|string|in:unpaid,paid',
        ]);

        $this->paymentService->updatePayment($id, $data);
        return redirect()->route('payment.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $this->paymentService->deletePayment($id);
        return redirect()->route('payment.index')->with('success', 'Payment deleted successfully.');
    }
}
