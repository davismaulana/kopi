<?php

namespace App\Services;

use App\Repositories\MenuRepository;

class MenuService
{
    protected $menuRepository;

    public function __construct(MenuRepository $menuRepository)
    {
        $this->menuRepository = $menuRepository;
    }

    public function getAllMenus()
    {
        return $this->menuRepository->all();
    }

    public function searchAndSort($search, $sortBy, $sortOrder)
    {
        return $this->menuRepository->searchAndSort($search, $sortBy, $sortOrder);
    }

    public function getMenu($id)
    {
        return $this->menuRepository->find($id);
    }

    public function createMenu(array $data)
    {
        return $this->menuRepository->create($data);
    }

    public function updateMenu($id, array $data)
    {
        return $this->menuRepository->update($id, $data);
    }

    public function updateMenuStock($id, $quantity)
    {
        return $this->menuRepository->updateStock($id, $quantity);
    }

    public function deleteMenu($id)
    {
        return $this->menuRepository->delete($id);
    }

    public function countData()
    {
        return $this->menuRepository->count();
    }

    public function countFood()
    {
        return $this->menuRepository->countFood();
    }

    public function countDrink()
    {
        return $this->menuRepository->countDrink();
    }
}