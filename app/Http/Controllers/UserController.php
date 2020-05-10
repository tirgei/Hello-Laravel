<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $data['token'] = $user->createToken('MyApp')->accessToken;
            return response()->json($data, 200);
        } else {
            return response()->json(['message' => 'Incorrect email/password', 'status' => 401], 401);
        }
    }

    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        } else {
            $data = $request->all();
            $data['password'] = bcrypt($data['password']);

            $user = User::create($data);
            return response()->json(['message' => 'User created successfully', 'status' => 201], 201);
        }
    }

    public function getUser() {
        $user = Auth::user();
        return response()->json(['data' => $user, 'status' => 200], 200);
    }
}

