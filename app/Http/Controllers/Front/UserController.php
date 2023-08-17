<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
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
                $user->status = 0;
                $user->save();

                //Activate the user only when user confirms his email account
                $email = $data['email'];
                $messageData = [
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'code' => base64_encode($data['email'])
                ];


                Mail::send('emails.confirmation', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Confirm your Stack Developers Account');
                });

                //Redirect back user with success message
                $redirectTo = url('user/login-register');
                return response()->json(['type'=>'success','url'=>$redirectTo,'message'=>'Please confirm your email to activate your account!']);

                //Activate the user straight way without sending any confirmation email
                // //Send Register Email
                // $email = $data['email'];
                // $messageData = ['name'=>$data['name'], 'mobile'=>$data['mobile'],'email'=>$data['email']];
                // Mail::send('emails.register',$messageData,function($message) use ($email){
                //     $message->to($email)->subject('Welcome to Stack Developers');
                // });
    
                // if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                //     $redirectTo = url('cart');
                //     //Update User Cart with user id
                //     if (!empty(Session::get('session_id'))) {
                //         $user_id = Auth::user()->id;
                //         $session_id = Session::get('session_id');
                //         Cart::where('session_id', $session_id)->update(['user_id' => $user_id]);
                //     }
                //     return response()->json(['type' => 'success','url' => $redirectTo]);
                // }



            }else{
                return response()->json(['type'=>'error','errors'=>$validator->messages()]);
            }
        }
    }

    public function userLogin(Request $request){
        if($request->Ajax()){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $validator = Validator::make(
                $request->all(),
                [
                    'email' => 'required|email|max:150|exists:users',
                    'password' => 'required|min:6',
                ]);
                if($validator->passes()) {
                if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {

                    if(Auth::user()->status==0){
                        Auth::logout();
                        return response()->json(['type'=>'inactive','message'=>'Your account is not activated! Please confirm your account to activate your account.']);
                    }

                    //Update User Cart with user id
                    if(!empty(Session::get('session_id'))){
                        $user_id = Auth::user()->id;
                        $session_id = Session::get('session_id');
                        Cart::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                    }

                    $redirectTo = url('cart');
                    return response()->json(['type' => 'success', 'url' => $redirectTo]);
                }else{
                    return response()->json(['type'=>'incorrect','message'=>'Incorrect Email or Password!']);
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

    public function confirmAccount($code){
        $email = base64_decode($code);
        $userCount = User::where('email', $email)->count();
        if($userCount>0){
            $userDetails = User::where('email',$email)->first();
            if($userDetails->status==1){
                //Redirect the user to Login/Register Page with error message
                return redirect('user/login-register')->with('error_message','Your account is already activated. You can login now.');
            }else{
                User::where('email',$email)->update(['status'=>1]);
                //Send Welcome Email
                $messageData = ['name'=>$userDetails->name, 'mobile'=> $userDetails->mobile,'email'=>$email];
                Mail::send('emails.register',$messageData,function($message) use ($email){
                    $message->to($email)->subject('Welcome to Stack Developers');
                });

                //Redirect the user to Login/Register Page with success message
                return redirect('user/login-register')->with('success_message', 'Your account is activated. You can login now.');

            }
        }else{
            abort(404);
        }
    }
}
