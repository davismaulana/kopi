<?php

namespace App\Services;

use App\Repositories\PTRepository;

class PTService
{
    protected $PTRepository;

    public function __construct(PTRepository $PTRepository)
    {
        $this->PTRepository = $PTRepository;
    }
    public function deletePaymentTransaction($id)
    {
        return $this->PTRepository->delete($id);
    }
}