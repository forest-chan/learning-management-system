<?php

namespace App\Users\Services;

use App\Users\Models\User;
use App\Users\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;

class UserService
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function index($searchParam = ''): Builder
    {
        return $this->userRepository->getAll($searchParam);
    }

    public function getTeachers(): Builder
    {
        return $this->userRepository->getTeachers();
    }

    public function getUser(int $id): User
    {
        return $this->userRepository->getUserById($id);
    }

    public function store($validated): User
    {
        $validated['password'] = Hash::make($validated['password']);
        return $this->userRepository->store($validated);
    }

    public function update($validated, $id): User
    {
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }
        $user = $this->getUser($id);
        $user->update($validated);
        return $user;
    }

    public function destroy($id): bool
    {
        if (auth()->id() != $id) {
            return $this->userRepository->destroy($id);
        } else {
            return false;
        }
    }

    public function restore($id): bool
    {
        return $this->userRepository->restore($id);
    }

    public function assignTeacher($id): bool
    {
        $user = $this->getUser($id);
        $user->is_teacher = 1;
        return $user->save();
    }
}
