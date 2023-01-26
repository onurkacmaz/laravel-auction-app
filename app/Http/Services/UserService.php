<?php

namespace App\Http\Services;

use App\Http\Requests\UserSaveRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUsers(): LengthAwarePaginator
    {
        return User::query()->paginate(User::PAGINATION_LIMIT);
    }

    public function deleteUser(int $id): void
    {
        User::query()->where('id', $id)->delete();
    }

    public function getUserById(int $id): User|Model
    {
        return User::query()->where('id', $id)->first();
    }

    public function updateOrCreate(UserSaveRequest $request, int|null $id = null): Model|User
    {
        if (is_null($request->password)) {
            $request->request->remove('password');
            $request->request->remove('password_confirmation');
        }else {
            $request->request->set('password', Hash::make($request->password));
        }

        return User::query()->updateOrCreate([
            'id' => $id
        ], $request->all());
    }

    public function getRoles(): Collection
    {
        return Role::query()->get();
    }
}
