<?php

namespace App\Http\Controllers;

use App\Services\MenuService;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $menus = $this->menuService->getAllMenus()->sortBy('name');
        $countMenu = $this->menuService->countData();
        $countFood = $this->menuService->countFood();
        $countDrink = $this->menuService->countDrink();
        return view('pages.menu.index', compact('menus','countMenu','countFood','countDrink'));
    }

    public function searchSort(Request $request) {}

    public function view($id)
    {
        $menu = $this->menuService->getMenu($id);

        if ($menu) {
            return response()->json($menu);
        }

        return response()->json(['message' => 'Menu not found'], 404);
    }


    public function create()
    {
        return view('pages.menu.create');
    }

    public function store(Request $request)
    {
        $hasMenus = $this->menuService->getAllMenus()->count() > 0;

        $rules = [
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'category' => 'required|in:food,drink',
        ];

        if ($hasMenus) {
            $rules['name'] = 'required|unique:menus,name';
        } else {
            $rules['name'] = 'required';
        }

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menu_images', 'public'); // Save image
        }else{
            $data['image'] = 'menu_images/coffee.png';
        }

        $data['name'] = ucwords(strtolower($data['name']));

        $this->menuService->createMenu($data);

        return redirect()->route('menu.index')->with('success', 'Menu created successfully.');
    }

    public function edit($id)
    {
        $menu = $this->menuService->getMenu($id);
        return view('pages.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|unique:menus,name,' . $id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'category' => 'required|in:food,drink',
        ]);

        $data['name'] = ucwords(strtolower($data['name']));

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menu_images', 'public'); 
        }

        $this->menuService->updateMenu($id, $data);
        return redirect()->route('menu.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy($id)
    {
        $this->menuService->deleteMenu($id);
        return redirect()->route('menu.index')->with('success', 'Menu deleted successfully.');
    }
}
