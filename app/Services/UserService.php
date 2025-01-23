<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAllUsers()
    {
        return $this->userRepository->all();
    }

    public function getUser($id)
    {
        return $this->userRepository->find($id);
    }

    public function createUser(array $data)
    {
        return $this->userRepository->create($data);
    }

    public function updateUser($id, array $data)
    {
        return $this->userRepository->update($id, $data);
    }

    public function deleteUser($id)
    {
        return $this->userRepository->delete($id);
    }

    public function countUser()
    {
        return $this->userRepository->countUser();
    }

    public function countAdmin()
    {
        return $this->userRepository->countAdmin();
    }

    public function countCashier()
    {
        return $this->userRepository->countCashier();
    }

    public function countCustomer()
    {
        return $this->userRepository->countCustomer();
    }
}