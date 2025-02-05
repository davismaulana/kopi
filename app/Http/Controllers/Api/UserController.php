<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        $users = $this->userService->getAllUsers();
        return response()->json(data: [
            'countUser' => $countUser,
            'countAdmin' => $countAdmin,
            'countCashier' => $countCashier,
            'users' => $users,
        ],status: 200);
    }

    public function searchSort(Request $request) {}

    public function show($id)
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

        $data = $this->userService->createUser($data);
        return response()->json([
            'message' => 'User created successfull',
            'data' => $data
        ],201);
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

        $data = $this->userService->updateUser($id, $data);
        return response()->json([
            'message' => 'Update successfull',
            'data' => $data
        ]);
    }

    public function destroy($id)
    {
        $this->userService->deleteUser($id);
        return response()->json([
            'message' => 'Delete successfull',
        ],200);
    }
}
