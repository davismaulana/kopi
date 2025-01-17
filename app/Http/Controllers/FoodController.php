<?php

namespace App\Http\Controllers;

use App\Services\FoodService;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class FoodController extends Controller
{
    protected $foodService;

    public function __construct(
        FoodService $foodService
    ){
        $this->foodService = $foodService;
    }

    public function index()
    {
        $foods = $this->foodService->getAllFoods();
        return view('pages.food.index',compact('foods'));
    }

    public function create()
    {
        return view('pages.food.create');
    }

    public function show($id){
        $foods = $this->foodService->getFood($id);
        return view('pages.food.index', compact('foods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:food,name',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $this->foodService->createFood($request->all());

        return redirect()->route('food.index')->with('success', 'Food item created successfully.');
    }

    public function edit($id)
    {
        $food = $this->foodService->getFood($id);
        return view('pages.food.edit', compact('food'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:food,name,' . $id,
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $this->foodService->updateFood($id, $request->all());
        return redirect()->route('food.index')->with('success', 'Food updated successfully.');
    }

    public function destroy($id)
    {
        $this->foodService->deleteFood($id);
        return redirect()->route('food.index')->with('success', 'Food deleted successfully.');
    }
}
