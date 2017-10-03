<?php namespace App\Services\User;

use App\Repositories\Interfaces\UserInterface;

class FindUserService
{
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function make(string $id)
    {
        return $this->user->findOrFail($id);
    }
}
