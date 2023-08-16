<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function loginRegister()
    {
        return view('front.users.login_register');
    }

    public function userRegister(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:100',
                'mobile' => 'required|numeric|digits:11',
                'email' => 'required|email|max:150|unique:users',
                'password' => 'required|min:6',
                'accept' => 'required'
            ],
            [
                'accept.required'=>'Please accept our Terms & Conditions'
            ]
        );


            if($validator->passes()){
                //Register the User
                $user = new User;
                $user->name = $data['name'];
                $user->mobile = $data['mobile'];
                $user->email = $data['email'];
                $user->password = bcrypt($data['password']);
                $user->status = 1;
                $user->save();
    
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                    $redirectTo = url('cart');
                    return response()->json(['type' => 'success','url' => $redirectTo]);
                }

            }else{
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }
    public function userLogout()
    {
        Auth::logout();
        return redirect('/');
    }
}
