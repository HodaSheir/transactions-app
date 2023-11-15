<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\Api\AuthResource;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(LoginRequest $request){
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
          $user = Auth::user();
          return $this->successResponse(AuthResource::make($user), __('successful login'), 200);
        }
        return $this->errorResponse([__('invalid email or password')], __('invalid email or password'), 401);
    }

    public function logout(Request $request){
        $request->user()->tokens->each(function ($token) {
            $token->delete();
        });

        return $this->successResponse(null, __('Successfully logged out'), 200);
    }

   
}
