<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function loginRegister() {
        return view('front.vendors.login_register');
    }

    public function vendorRegister(Request $request) {
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            //Validate Vendor
            $rules = [
               "name" => "required",
               "email" => "required|email|unique:admins|unique:vendors",
               "mobile" => "required|min:10|numeric|unique:admins|unique:vendors",
               "accept" => "required"
            ];
            $customMessages = [
               "name.required" => "Name is required",
               "email.required" => "Email is required",
               "email.unique" => "Email already exists",
               "mobile.required" => "Mobile is required",
               "mobile.unique" => "Mobile already exists",
               "accept.required" => "Please accept T&C",
            ];
            $validator = Validator::make($data,$rules,$customMessages);
            if($validator->fails()){
               return Redirect::back()->withErrors($validator);
            }

            
            DB::beginTransaction();

            //Create Vendor Account

            //Insert the Vendor details in vendors table
            $vendor = new Vendor;
            $vendor->name = $data['name'];
            $vendor->mobile = $data['mobile'];
            $vendor->email = $data['email'];
            $vendor->status = 0;

            //Set Default Timezone to Brazil
            date_default_timezone_set("America/Sao_Paulo");
            $vendor->created_at = date("Y-m-d H:i:s");
            $vendor->updated_at = date("Y-m-d H:i:s");
            $vendor->save();

            $vendor_id= DB::getPdo()->lastInsertId();

            //Insert the Vendor details in admins table
            $admin = new Admin;
            $admin->type = 'vendor';
            $admin->vendor_id = $vendor_id;
            $admin->name = $data['name'];
            $admin->mobile = $data['mobile'];
            $admin->email = $data['email'];
            $admin->password = bcrypt($data['password']);
            $admin->status = 0;

            //Set Default Timezone to Brazil
            date_default_timezone_set("America/Sao_Paulo");
            $admin->created_at = date("Y-m-d H:i:s");
            $admin->updated_at = date("Y-m-d H:i:s");
            $admin->save();

            //Send Confirmation Email
            $email = $data['email'];
            $messageData = [
                'email' => $data['email'],
                'name' => $data['name'],
                'code' => base64_encode($data['email'])
            ];

            Mail::send('emails.vendor_confirmation', $messageData, function ($message) use ($email) {
                $message->to($email)->subject('Confirm your VendorAccount');
            });
            DB::commit();


            //Redirect back Vendor with Success Message
            $message = "Thank you registering as Vendor. We will confirm by email once your account is approved.";
            return redirect()->back()->with('success_message',$message);
        }
    }
    public function confirmVendor($email) {
        //Decode Vendor Email
        echo $email = base64_decode($email); die;


    }
}
