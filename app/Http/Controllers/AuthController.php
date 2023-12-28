<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
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
        $this->middleware('auth:api', ['except' => ['login', 'forgotPassword']]);
    }

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

    /**
     * Forgot Password
     */
    public function forgotPassword(Request $request){
        $validator = Validator::make(request()->all(),[
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $email = request('email');
        $user = User::where('email', $email)->first();
        if ($user) {
            $details = [
                'title' => 'Your Request to Reset Password',
                'body' => 'Thank you for requesting to reset your password. Here we send you the One Time Password (OTP) to reset your password. Please use this OTP to reset your password.',
                'otp' => '645214',
                'body2' => 'This One Time Password (OTP) will expire in 5 minutes and can only be used once. Please do not share this OTP with anyone. Someone may be trying to hack you.',
                'body3' => 'If you did not request a password reset, no further action is required.',
                'notes' => 'This is an automated email, please do not reply!',
            ];
            Mail::to('sendyjoan5@gmail.com')->send(new \App\Mail\MyTestMail($details));
            return response()->json(['message' => 'We have e-mailed your one time password!']);
        } else {
            return response()->json(['message' => 'Email not found!'], 203);
        }
    }
}
