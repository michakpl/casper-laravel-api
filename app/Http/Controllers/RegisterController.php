<?php namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserStore;
use App\Services\User\CreateUserService;

class RegisterController extends Controller
{
    protected $createUser;

    public function __construct(CreateUserService $createUser)
    {
        $this->createUser = $createUser;
    }

    public function register(UserStore $request)
    {
        $user = $this->createUser->make($request->only([
            'username',
            'email',
            'password',
            'gender',
            'birthdate'
        ]));

        if ($user) {
            return response()->json([
                'message'   => 'You have been successfully registered. You can log in now'
            ]);
        }

        return response()->json([
            'message'   => 'Something went wrong'
        ], 500);
    }
}
