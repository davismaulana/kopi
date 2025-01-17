<?php

namespace App\Services;

use App\Repositories\CustomerRepository;

class CustomerService
{
    protected $customerRepository;

    public function __construct(CustomerRepository $customerRepository)
    {
        $this->customerRepository = $customerRepository;
    }

    public function getAllCustomers()
    {
        return $this->customerRepository->all();
    }

    public function getCustomer($id)
    {
        return $this->customerRepository->find($id);
    }

    public function createCustomer(array $data)
    {
        return $this->customerRepository->create($data);
    }

    public function updateCustomer($id, array $data)
    {
        return $this->customerRepository->update($id, $data);
    }

    public function deleteCustomer($id)
    {
        return $this->customerRepository->delete($id);
    }

    public function countData()
    {
        return $this->customerRepository->count();
    }
}