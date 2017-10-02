<?php namespace App\Services\User;

use App\Repositories\Interfaces\UserInterface;

class UsersListFetcherService
{
    protected $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    public function make(array $attributes = [])
    {
        return $this->user->all();
    }
}
