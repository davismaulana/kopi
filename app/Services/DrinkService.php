<?php

namespace App\Services;

use App\Repositories\DrinkRepository;

class DrinkService
{
    protected $drinkRepository;

    public function __construct(DrinkRepository $drinkRepository)
    {
        $this->drinkRepository = $drinkRepository;
    }

    public function getAllDrinks()
    {
        return $this->drinkRepository->all();
    }

    public function getDrink($id)
    {
        return $this->drinkRepository->find($id);
    }

    public function createDrink(array $data)
    {
        return $this->drinkRepository->create($data);
    }

    public function updateDrink($id, array $data)
    {
        return $this->drinkRepository->update($id, $data);
    }

    public function deleteDrink($id)
    {
        return $this->drinkRepository->delete($id);
    }

    public function countData()
    {
        return $this->drinkRepository->count();
    }
}