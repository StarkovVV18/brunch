<?php
namespace App\Http\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function GetAll()
    {
        return response()->json(User::get()->toArray());
    }

    public function Create(UserRequest $request)
    {
        $name = $request->get('name');
        $email = $request->get('email');
        $phone = $request->get('phone');
        $password = md5($request->get('password'));

        $user = User::create([
            'name' => $name,
            'password' => $password,
            'email' => $email,
            'phone' => $phone,
        ]);

        return response()->json($user);
    }
}
