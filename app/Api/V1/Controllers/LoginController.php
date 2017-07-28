<?php

namespace App\Api\V1\Controllers;

use App\User;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class LoginController extends Controller
{
    public function login(LoginRequest $request, JWTAuth $JWTAuth)
    {
        $user_count = User::where('email', $request->input('email'))->count();

        if(!$user_count)
        {
           $user = User::create([
              'name'    =>  $request->input('name'),
              'email'   =>  $request->input('email')
           ]);

        }
        else
        {
            $user = $user = User::where('email', $request->input('email'))->first();
        }




        try {
            $token = $JWTAuth->fromUser($user);

            if(!$token) {
                throw new AccessDeniedHttpException();
            }

        } catch (JWTException $e) {
            throw new HttpException(500);
        }

        return response()
            ->json([
                'status' => 'ok',
                'token' => $token
            ]);
    }
}
