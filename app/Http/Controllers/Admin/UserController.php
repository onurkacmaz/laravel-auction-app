<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSaveRequest;
use App\Http\Services\UserService;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): View
    {
        $users = $this->userService->getUsers();
        return view('admin.users.index', ['users' => $users]);
    }

    public function form(int|null $id = null): View
    {
        if (is_null($id)) {
            $user = new User();
        } else {
            $user = $this->userService->getUserById($id);
        }

        return view('admin.users.form', [
            'user' => $user,
            'roles' => $this->userService->getRoles()
        ]);
    }

    public function save(UserSaveRequest $request, int|null $id = null): RedirectResponse
    {
        $user = $this->userService->updateOrCreate($request, $id);
        return redirect()->route('admin.users.edit', ['id' => $user->id]);
    }

    public function destroy($id): RedirectResponse
    {
        $this->userService->deleteUser($id);
        return redirect()->route('admin.users.index');
    }
}
