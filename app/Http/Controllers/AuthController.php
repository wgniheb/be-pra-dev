<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

//    public function register()
//    {
//        $validator = Validator::make(request()->all(),[
//            'name' => 'required',
//            'email' => 'required|email|unique:users',
//            'password' => 'required'
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json($validator->messages());
//        }
//
//        $user = User::create([
//            'name' => request('name'),
//            'email' => request('email'),
//            'password' => Hash::make(request('password')),
//        ]);
//
//        if ($user) {
//            return response()->json(['message' => 'Pendaftaran Berhasil']);
//        } else {
//            return response()->json(['message' => 'Pendaftaran Gagal!']);
//        }
//
//    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $validator = Validator::make(request()->all(),[
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $credentials = request(['email', 'password']);
        // if (! $token = auth()->claims(['email' => $email , 'e' => 'a'])->attempt($credentials)) {
        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Credential not found!'], 202);
        }
        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $data = array("data" => ["name" => auth()->user()->name, "email" => auth()->user()->email]);
        return response()->json($data,200);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $data = array("data" => ["token" => $token,
        "token_type" => "Bearer",
        "expires_in" => auth()->factory()->getTTL() * 5],
        );
        return response()->json($data,200);
    }
}
