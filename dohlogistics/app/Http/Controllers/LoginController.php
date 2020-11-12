<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 07/07/2020
 * Time: 9:33 PM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Model\Account;

class LoginController extends Controller
{
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function initLogin()
    {
        $input = $this->request->post();
        $currLogin = Account::where('username', $input['username'])->first();
        if(empty($currLogin))
        {
            return response()->json('Your account does not exist!', 404);
        }

        if(password_verify($input['password'], $currLogin['password']) === false)
        {
            return response()->json('You have entered an Incorrect Password!', 401);
        }
        //set token
        $token = $this->createToken();
        $currLogin->update(['token' => $token]);

        //set sessions
        $_SESSION['user'] = $currLogin['username'];
        $_SESSION['token'] = $token;
        $_SESSION['role'] = $currLogin['role'];

        return response()->json($currLogin['role'], 200);
    }
    public function createToken()
    {
        $token = str_shuffle('qkz@-!2l9#1aeWx');
        $duplicate = Account::where('token', $token)->count();

        while($duplicate > 0)
        {
            $token = str_shuffle($token);
        }
        return $token;
    }
}
