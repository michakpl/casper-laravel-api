<?php namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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
}
