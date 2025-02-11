<?php

namespace App\Services;

use App\Repositories\PaymentRepository;

class PaymentService
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function getAllPayments()
    {
        return $this->paymentRepository->all();
    }

    public function getPayment($id)
    {
        return $this->paymentRepository->find($id);
    }

    public function getPaymentWithMenu($id)
    {
        return $this->paymentRepository->findMenu($id);
    }

    public function createPayment(array $data)
    {
        return $this->paymentRepository->create($data);
    }

    public function updatePayment($id, array $data)
    {
        return $this->paymentRepository->update($id, $data);
    }

    public function deletePayment($id)
    {
        return $this->paymentRepository->delete($id);
    }

    public function countData()
    {
        return $this->paymentRepository->count();
    }

    public function countGraph()
    {
        return $this->paymentRepository->countGraph();
    }
}