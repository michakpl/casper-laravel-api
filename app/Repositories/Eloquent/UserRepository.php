<?php namespace App\Repositories\Eloquent;

use Carbon\Carbon;
use App\Models\User;
use App\Abstracts\EloquentRepository;
use App\Repositories\Interfaces\UserInterface;

class UserRepository extends EloquentRepository implements UserInterface
{
    public function __construct(User $user)
    {
        $this->model = $user;

        parent::__construct();
    }

    public function create(array $attributes, $parent = false)
    {
        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['birthdate'] = Carbon::parse($attributes['birthdate']);

        $user = $this->model->create($attributes);

        return $user;
    }
}
