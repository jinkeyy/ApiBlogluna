<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }
    public function register(Request $request){
        try{
        $user = $this->user->create([
            'username' => $request->get('username'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password'))
        ]);
        return response()->json([
            'status'=> 200,
            'message'=> 'User created successfully',
            'data'=>$user
        ]);
        }catch(Exception $e){
            return "Đăng kí thất bại, trùng email hoặc mật khẩu không trùng khớp ".$e;
        }

    }
    public function login(Request $request){
        $credentials = $request->only(['email','password']);
        $token = null;
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        $users = DB::select('select * from users where email = "'.$request->input("email").'"');
        return response()->json(
            [
                "token"=>$token,
                "username"=> $users[0]->username,
            ]
        );
    }
    public function logout(Request $request) {
        $tokenString = $request->header("Authorization");
        try {
            JWTAuth::manager()->invalidate(new \Tymon\JWTAuth\Token($tokenString), $forceForever = false);
            return response()->json([
            'status' => 'success',
            'msg' => 'You have successfully logged out.'
          ]);
        } catch (JWTException $e) {
            JWTAuth::unsetToken();
            return response()->json([
              'status' => 'error',
              'msg' => 'Failed to logout, please try again.'
          ]);
        }
      }


}