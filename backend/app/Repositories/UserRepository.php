<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function findByEmail(string $email)
    {
        return $this->model->where('email', $email)->first();
    }

    public function findByRole(string $role)
    {
        return $this->model->where('role', $role)->get();
    }

    public function toggleStatus(int $id)
    {
        $user = $this->findOrFail($id);
        $user->is_active = !$user->is_active;
        $user->save();
        return $user;
    }

    public function approveFarmer(int $id)
    {
        $user = $this->findOrFail($id);
        $user->is_approved = true;
        $user->save();
        return $user;
    }
}