<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EditProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = $request->user();

        $validation = Validator::make($request->all(), [
            'full_name' => 'required|string',
            'username' => 'required|min:7|max:35|alpha_num|unique:users,username,' . $user->id,
            'phone_number' => 'required|numeric|unique:users,phone_number,' . $user->id,
            'email' => 'required|numeric|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|max:10096|mimes:jpg,jpeg,gif,png',
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

        $user->full_name = $request->full_name;
        $user->username = $request->username;
        $user->phone_number = $request->phone_number;
        $user->phone_no = $request->phone_no;
        $user->email = $request->email;
        $user->profile_picture = $request->file("profile_picture") ? $imgUploadedPath : $user->profile_picture;
        $user->update();

        return response()->json([
            "data" => new UserResource($user)
        ], 200);
    }
}
