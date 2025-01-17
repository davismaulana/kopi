<?php

namespace App\Services;

use App\Repositories\FoodRepository;

class FoodService
{
    protected $foodRepository;

    public function __construct(FoodRepository $foodRepository)
    {
        $this->foodRepository = $foodRepository;
    }

    public function getAllFoods()
    {
        return $this->foodRepository->all();
    }

    public function getFood($id)
    {
        return $this->foodRepository->find($id);
    }

    public function createFood(array $data)
    {
        return $this->foodRepository->create($data);
    }

    public function updateFood($id, array $data)
    {
        return $this->foodRepository->update($id, $data);
    }

    public function deleteFood($id)
    {
        return $this->foodRepository->delete($id);
    }

    public function countData()
    {
        return $this->foodRepository->count();
    }
}