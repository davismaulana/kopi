<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\PaymentService;
use App\Services\PTService;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentService;
    protected $PTService;

    public function __construct(PaymentService $paymentService, PTService $PTService)
    {
        $this->paymentService = $paymentService;
        $this->PTService = $PTService;
    }

    public function index()
    {
        $payments = $this->paymentService->getAllPayments();
        return response()->json([
            'payments' => $payments
        ]);
    }

    public function searchSort(Request $request) {}

    public function show($id)
    {
        $payment = $this->paymentService->getPaymentWithMenu($id);

        return response()->json([
            'customer_name' => $payment->customer_name,
            'payment_date' => $payment->payment_date,
            'payment_method' => $payment->payment_method,
            'amount' => $payment->amount,
            'menus' => $payment->menus->map(function ($menu) {
                return [
                    'name' => $menu->name,
                    'price' => $menu->price,
                    'pivot' => [
                        'count' => $menu->pivot->count,
                    ], 200
                ];
            }),
        ]);
    }

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

        $data = $this->paymentService->updatePayment($id, $data);
        return response()->json([
            'message' => 'Update successfull',
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $this->PTService->deletePaymentTransaction($id);
        $this->paymentService->deletePayment($id);
        return response()->json([
            'message' => 'Delete successfull'
        ]);
    }
}
