<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $countUser = $this->userService->countUser();
        $countAdmin = $this->userService->countAdmin();
        $countCashier = $this->userService->countCashier();
        $countCustomer = $this->userService->countCustomer();
        $users = $this->userService->getAllUsers()->sortBy('name');
        return view('pages.user.index', compact('users','countUser','countAdmin','countCashier','countCustomer'));
    }

    public function searchSort(Request $request) {}

    public function view($id)
    {
        $menu = $this->userService->getUser($id);

        if ($menu) {
            return response()->json($menu);
        }

        return response()->json(['message' => 'User not found'], 404);
    }


    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'level' => 'required|in:cashier,admin',
        ]);

        $removeSpaces = str_replace(' ', '', $data['name']);
        $data['password'] = bcrypt($removeSpaces . '123');

        $this->userService->createUser($data);
        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = $this->userService->getUser($id);
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|unique:users,name,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'level' => 'required|in:cashier,admin',
        ]);

        $removeSpaces = str_replace(' ', '', $data['name']);
        $data['password'] = bcrypt($removeSpaces . '123');

        $this->userService->updateUser($id, $data);
        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
