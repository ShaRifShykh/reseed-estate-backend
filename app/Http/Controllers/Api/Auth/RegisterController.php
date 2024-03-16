<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string',
            'phone_number' => 'required|numeric|unique:users',
        ]);

        if ($validation->fails()) {
            return response()->json([
                "errors" => $validation->errors()
            ], 400, [], JSON_NUMERIC_CHECK);
        }

        $user = new User();
        $user->full_name = $request->name;
        $user->phone_number = $request->phone_number;
        $user->otp = rand(111111, 999999);
        $user->save();

        // send otp to user phone no
//        $basic  = new Basic(
//            env("VONAGE_KEY"),
//            env("VONAGE_SECRET"));
//        $client = new Client($basic);
//
//        $client->sms()->send(
//            new SMS(
//                "923480984422",
//                "Reseed Estate",
//                'Here is your otp ' . $user->otp . '.')
//        );

        return response()->json([
            "success" => true,
            "otp" => $user->otp,
        ], 200);
    }


    public function addInfo(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'profile_picture' => 'required|max:10096|mimes:jpg,jpeg,gif,png',
            'username' => 'required|string|unique:users',
        ]);

        if ($validation->fails()) {
            return response()->json([
                "errors" => $validation->errors()
            ], 400, [], JSON_NUMERIC_CHECK);
        }

        if ($request->file("profile_picture")) {
            $uploadFolder = "users/profilePictures";
            $img = $request->file("profile_picture");
            $imgUploadedPath = $img->store($uploadFolder, "public");
            Storage::disk("public")->url($imgUploadedPath);
        }

        $user = User::find($request->user()->id);
        $user->profile_picture = $imgUploadedPath;
        $user->username = $request->username;
        $user->save();

        return response()->json([
            "data" => new UserResource($user)
        ], 200);
    }
}
