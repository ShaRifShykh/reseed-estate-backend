<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function verifyOtp(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'otp' => 'required|numeric',
            'phone_number' => 'required|numeric',
        ]);

        if ($validation->fails()) {
            return response()->json([
                "errors" => $validation->errors()
            ], 400, [], JSON_NUMERIC_CHECK);
        }

        $user = User::where("phone_number", "=", $request->phone_number)
            ->first();

        if ($user->otp == $request->otp) {
            $user->otp = null;
            $user->save();

            return response()->json([
                "token" => $user->createToken('ReseedEstate')->accessToken,
            ], 200);
        } else {
            return response()->json([
                'errors' => [
                    "error" => "Wrong OTP!"
                ]
            ], 400, [], JSON_NUMERIC_CHECK);
        }
    }


    public function user(Request $request)
    {
        $user = User::find($request->user()->id);

        return response()->json([
            'data' => new UserResource($user),
        ], 200);
    }


    public function getUser(Request $request, $id)
    {
        $user = User::find($id);

        return response()->json([
            'data' => new UserResource($user),
        ], 200);
    }


    public function allUsers(Request $request)
    {
        $users = User::all();

        return response()->json([
            'data' => UserResource::collection($users),
        ], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'User Logged Out!'
        ], 200, [], JSON_NUMERIC_CHECK);
    }
}
