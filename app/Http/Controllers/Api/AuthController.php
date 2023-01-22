<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
class AuthController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['id'] = $user->id;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Register api
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $email = User::where('email', '=', $input['email'])->first();
        if (!$email) {
            $user = User::create($input);
            $success['token'] = $user->createToken('MyApp')->accessToken;
            $success['id'] = $user->id;
            return response()->json(['success' => $success], $this->successStatus);
        } else {
            return response()->json(['error' => 'Email Already Exist'], 400);
        }
    }

    public function passwordUpdate(Request $request)
    {
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->update();
        return response()->json(['success' => 'Successfully Updated']);
    }

    public function sendOtpEmail(Request $request)
    {
        $otp = rand(1000, 9999);
        $user = User::where('email', '=', $request->email)->first();
        if ($user) {
            $user->otp = $otp;
            $user->update();
            $dataa = array(
                'otp' => $otp,
                'email' => $user->email,
            );
            dispatch(new OtpMailJob($dataa))->delay(Carbon::now()->addSeconds(5));
            return response()->json(['success' => 'Otp send'], 200);
        } else {
            return response()->json(['error' => 'User not exist'], 404);
        }
    }

    public function otpVerifyEmail(Request $request)
    {
        $user = User::where('email', $request->email)->where('otp', $request->otp)->first();
        if ($user) {
            $user->otp = null;
            $user->email_verified_at = 1;
            $user->update();
            return response()->json(['success' => 'Otp Verify'], 200);
        } else {
            return response()->json(['success' => 'Otp Not match'], 404);
        }
    }

    public function forgetPassword(Request $request)
    {
        $user = User::where('email', '=', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->update();
        auth()->login($user, true);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['id'] = $user->id;
        return response()->json(['success' => $success], $this->successStatus);
    }
    public function token($token)
    {
        $user = auth()->user();
        $user->device_token = $token;
        $user->update();
        return response()->json(['success' => 'successfully updated']);
    }
}
