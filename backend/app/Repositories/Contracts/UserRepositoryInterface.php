<?php

namespace App\Repositories\Contracts;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function findByEmail(string $email);
    public function findByRole(string $role);
    public function toggleStatus(int $id);
    public function approveFarmer(int $id);
}