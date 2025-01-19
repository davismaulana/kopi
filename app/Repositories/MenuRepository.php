<?php

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository implements MenuRepositoryInterface
{
    public function all()
    {
        return Menu::all();
    }

    public function searchAndSort($search, $sortBy, $sortOrder)
    {
        $menus = Menu::query()
        ->when($search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('category', 'like', '%' . $search . '%');
        })
        ->orderBy($sortBy, $sortOrder)
        ->get();

        return $menus;
    }

    public function find($id)
    {
        return Menu::findOrFail($id);
    }

    public function create(array $data)
    {
        return Menu::create($data);
    }

    public function update($id, array $data)
    {
        $menu = Menu::findOrFail($id);
        $menu->update($data);
        return $menu;
    }

    public function delete($id)
    {
        $category = Menu::findOrFail($id);
        $category->delete();
    }

    public function count()
    {
        $count = Menu::count();
        return $count;
    }
}