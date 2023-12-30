<?php

namespace App\Http\Controllers;

use App\Models\Otp;
use Illuminate\Support\Facades\Mail;
use Throwable;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'forgotPassword', 'otpVerification', 'resetPassword']]);
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

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Credential Not Found!'], 202);
        } else {
            $user = User::with('userstatus')->where('email', request('email'))->first();
            $suspend = $user->userstatus->name == 'Suspended' ? true : false;
            if ($suspend) {
                return response()->json(['message' => 'Your account has been suspended!'], 203);
            }else{
                return $this->respondWithToken($token);
            }
        }
        // return $this->respondWithToken($token);


        // $user = User::with('userstatus')->where('email', request('email'))->first();

        // $suspend = $user->userstatus->name == 'Suspended' ? true : false;

        // if ($suspend) {
        //     return response()->json(['message' => 'Your account has been suspended!'], 203);
        // }else{
        //     if (! $token = auth()->attempt($credentials)) {
        //         return response()->json(['message' => 'Credential not found!'], 202);
        //     }
        //         return $this->respondWithToken($token);
        // }
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

    public function profile(){
        $data = array("data" => [
            "name" => auth()->user()->name,
            "email" => auth()->user()->email,
            "role" => auth()->user()->role->name,
        ]);
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

        $otp = random_int(000001, 999999);
        $req = Carbon::now();
        $exp = Carbon::now()->addMinutes(5);

        $data = Otp::create([
            'otp' => $otp,
            'request_time' => $req,
            'expired_time' => $exp,
        ]);

        $data->user()->associate($user);
        $data->save();

        if ($user) {
            $details = [
                'title' => 'Your Request to Reset Password',
                'body' => 'Thank you for requesting to reset your password. Here we send you the One Time Password (OTP) to reset your password. Please use this OTP to reset your password.',
                'otp' => $otp,
                'body2' => 'This One Time Password (OTP) will expire in 5 minutes and can only be used once. Please do not share this OTP with anyone. Someone may be trying to hack you.',
                'body3' => 'If you did not request a password reset, no further action is required.',
                'notes' => 'This is an automated email, please do not reply!',
            ];
            Mail::to($email)->send(new \App\Mail\MyTestMail($details));
            return response()->json(['message' => 'We have e-mailed your one time password!'], 200);
        } else {
            return response()->json(['message' => 'Email not found!'], 203);
        }
    }

    public function otpVerification(Request $request){
        $validator = Validator::make(request()->all(),[
            'otp' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $otp = request('otp');
        $data = Otp::with('user')->where('otp', $otp)->first();

        if ($data) {
            $now = Carbon::now();
            $exp = $data->expired_time;
            if ($now > $exp) {
                $data->delete();
                return response()->json(['message' => 'One Time Password Expired!'], 203);
            } else {
                return response()->json(['message' => 'OTP Verified!', 'otp' => $otp, 'email' => $data->user->email], 200);
            }
        } else {
            return response()->json(['message' => 'One Time Password Not found!'], 203);
        }
    }

    public function resetPassword(Request $request){
        $validator = Validator::make(request()->all(),[
            'otp' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages());
        }

        $otp = request('otp');
        $email = request('email');
        $password = request('password');
        $user = User::where('email', $email)->first();

        $data = Otp::with('user')->where('otp', $otp)->first();

        if ($data->user->email == $email && $data->expired_time > Carbon::now()) {
            $user->password = Hash::make($password);
            $user->save();
            $data->verified_time = Carbon::now();
            $data->save();
            $data->delete();

            //clear OTP data with this email
            $data = Otp::where('user_id', $user->id);
            $data->delete();

            return response()->json(['message' => 'Password successfully changed!'], 200);
        } else {
            $data->delete();
            return response()->json(['message' => 'One Time Password is Expired'], 203);
        }
    }
}
