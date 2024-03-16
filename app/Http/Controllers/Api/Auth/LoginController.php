<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;
use function PHPUnit\Framework\isEmpty;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'phone_no' => 'required|numeric',
        ]);

        if ($validation->fails()) {
            return response()->json([
                "errors" => $validation->errors()
            ], 400, [], JSON_NUMERIC_CHECK);
        }

        $user = User::where("phone_number", "=", $request->phone_no)
            ->first();

        if ($user == null) {
            return response()->json([
                'errors' => [
                    "error" => "User doesn't exists!"
                ]
            ], 400, [], JSON_NUMERIC_CHECK);
        } else {
            $user->otp = rand(111111, 999999);
            $user->save();

//            $basic  = new Basic(
//                env("VONAGE_KEY"),
//                env("VONAGE_SECRET"));
//            $client = new Client($basic);
//
//            $client->sms()->send(
//                new SMS(
//                    "923480984422",
//                    "Reseed Estate",
//                    'Here is your otp ' . $user->otp . '.')
//            );

            return response()->json([
                "success" => true,
                "otp" => $user->otp,
            ], 200);
        }
    }
}
