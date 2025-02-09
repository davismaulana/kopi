<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $menus = $this->menuService->getAllMenus();
        $countMenu = $this->menuService->countData();
        $countFood = $this->menuService->countFood();
        $countDrink = $this->menuService->countDrink();
        
        return response()->json([
            'menus' => $menus,
            'countMenu' => $countMenu,
            'countFood' => $countFood,
            'countDrink' => $countDrink
        ],200);
    } 

    public function searchSort(Request $request) {}

    public function show($id)
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

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        $data = $request->validate($rules);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menu_images', 'public'); // Save image
        }else{
            $data['image'] = 'menu_images/coffee.png';
        }

        $data['name'] = ucwords(strtolower($data['name']));

        $menu = $this->menuService->createMenu($data);

        return response()->json([
            'message' => 'Menu created successfully',
            'data' => $menu
        ],201);
    }

    public function edit($id)
    {
        $menu = $this->menuService->getMenu($id);
        return view('pages.menu.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = $this->menuService->getMenu($id);

        if (!$menu) {
            return response()->json([
                'message' => 'Menu not found'
            ],404);
        }

        $rules = [
            'name' => 'required|unique:menus,name,' . $id,
            'price' => 'required|numeric|min:0',
            'stock' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048',
            'category' => 'required|in:food,drink',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ],422);
        }

        $data = $validator->validated();

        $data['name'] = ucwords(strtolower($data['name']));

        if ($request->hasFile('image')) {
            if ($menu->image && Storage::disk('public')->exists($menu->image)) {
                Storage::disk('public')->delete($menu->image);
            }

            $data['image'] = $request->file('image')->store('menu_images', 'public'); 
        } else {
            $data['image'] = $menu->image;
        }

        $updated = $this->menuService->updateMenu($id, $data);

        return response()->json([
            'message' => 'Edit menu successfully',
            'data' => $updated
        ],200);
    }

    public function destroy($id)
    {
        $this->menuService->deleteMenu($id);
        return response()->json([
            'message' => 'Delete menu successfull'
        ],200);
    }
}
