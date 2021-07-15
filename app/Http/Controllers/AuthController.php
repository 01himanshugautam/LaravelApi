<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Device;
use App\models\User;
use App\models\students;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $req)
    {
        $user = new User;
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = $req->password;
        $result = $user->save();
        if ($result) {
            return ["Result" => "User Register"];
        } else {
            return ["Result" => "Operation Failed"];
        }
    }

    function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['These credentials do not match our records.']
            ], 404);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    public function update(Request $req)
    {
        $user = User::find($req->id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->password = $req->password;
        $result = $user->save();
        if ($result) {
            return ["Result" => "User Data has been updated"];
        } else {
            return ["Result" => "Operation Failed"];
        }
    }
    public function search($name)
    {

        return Device::where("name", $name)->get();
    }

    public function user($email = null)
    {
        $success = $email ? User::where('email', $email)
            ->get() : User::all();

        return response()->json($success);
        // return $email ? User::find($email) : User::all();
    }


    public function devices($id = null)
    {
        return
            $id ? Device::find($id) : Device::all();
    }

    public function students()
    {
        return Students::all();
    }
}