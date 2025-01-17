<?php

namespace App\Http\Controllers;

use App\Services\DrinkService;
use Illuminate\Http\Request;

class DrinkController extends Controller
{
    protected $drinkService;

    public function __construct(
        DrinkService $drinkService
    ){
        $this->drinkService = $drinkService;
    }

    public function index()
    {
        $drinks = $this->drinkService->getAllDrinks();
        return view('pages.drink.index',compact('drinks'));
    }

    public function create()
    {
        return view('pages.drink.create');
    }

    public function show($id){
        $drinks = $this->drinkService->getDrink($id);
        return view('pages.drink.index', compact('drinks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:drink,name',
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $this->drinkService->createDrink($request->all());

        return redirect()->route('drink.index')->with('success', 'Drink item created successfully.');
    }

    public function edit($id)
    {
        $drink = $this->drinkService->getDrink($id);
        return view('pages.drink.edit', compact('drink'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:drink,name,' . $id,
            'price' => 'required|numeric',
            'stock' => 'required|numeric'
        ]);

        $this->drinkService->updateDrink($id, $request->all());
        return redirect()->route('drink.index')->with('success', 'Drink updated successfully.');
    }

    public function destroy($id)
    {
        $this->drinkService->deleteDrink($id);
        return redirect()->route('drink.index')->with('success', 'Drink deleted successfully.');
    }
}
