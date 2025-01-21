<?php

namespace App\Http\Controllers;

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
        $payments = $this->paymentService->getAllPayments()->sortByDesc('created_at');
        return view('pages.payment.index', compact('payments'));
    }

    public function searchSort(Request $request) {}

    public function view($id)
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
                    ],
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

        $this->paymentService->updatePayment($id, $data);
        return redirect()->route('payment.index')->with('success', 'Payment updated successfully.');
    }

    public function destroy($id)
    {
        $this->PTService->deletePaymentTransaction($id);
        $this->paymentService->deletePayment($id);
        return redirect()->route('payment.index')->with('success', 'Payment deleted successfully.');
    }
}
