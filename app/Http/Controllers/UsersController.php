<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Services\User\UsersListFetcherService;

class UsersController extends Controller
{
    protected $usersListFetcher;

    public function __construct(UsersListFetcherService $usersListFetcher)
    {
        $this->usersListFetcher = $usersListFetcher;
    }

    public function currentUser()
    {
        $user = Auth::user();

        if ($user) {
            return response()->json([
                'user'  => $user
            ]);
        }

        return response()->json([
            'message'   => 'You are not authenticated'
        ], 401);
    }

    public function index(Request $request)
    {
        $users = $this->usersListFetcher->make($request->all());

        if ($users) {
            return response()->json([
                'users' => $users
            ]);
        }

        return response()->json([
            'message'   => 'Something went wrong'
        ], 500);
    }
}
