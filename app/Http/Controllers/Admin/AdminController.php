<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\VendorsBusinessDetail;
use App\Models\VendorsBankDetail;
use App\Models\Country;
use Image;

class AdminController extends Controller
{
    public function dashboard()
    {
        Session::put('page', 'dashboard');
        return view('admin.dashboard');
    }
    public function updateAdminPassword(Request $request)
    {
        Session::put('page', 'update_admin_password');
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die;
            //Check if current password entered by admin is correct
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                //Check if new password is matching with confirm password
                if ($data['confirm_password'] == $data['new_password']) {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return redirect()->back()->with('success_message', 'Password has been updated successfully!');
                } else {
                    return redirect()->back()->with('error_message', 'New Password and Confirm Password does not match!');
                }
            } else {
                return redirect()->back()->with('error_message', 'Your current password is Incorrect!');
            }
        }
        $adminDetails = Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray();
        return view('admin.settings.update_admin_password')->with(compact('adminDetails'));
    }

    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
            return "true";
        } else {
            return "false";
        }
    }

    public function updateAdminDetails(Request $request)
    {
        Session::put('page', 'update_admin_details');
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die();
            $rules = [
                'admin_name' => 'required|regex:/^[\pL\s\-\d]+$/u',
                'admin_mobile' => 'required|numeric',
            ];
            $customMessages = [
                'admin_name.required' => 'Name is required',
                'admin_name.regex' => 'Valid Name is required',
                'admin_mobile.required' => 'Mobile is required',
                'admin_mobile.numeric' => 'Valid Mobile is required',
            ];
            $this->validate($request, $rules, $customMessages);
            //Upload Admin Photo
            if ($request->hasFile('admin_image')) {
                $image_tmp = $request->file('admin_image');
                if ($image_tmp->isValid()) {
                    //Get Image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    //Generate New Image Name
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $imagePath = 'admin/images/photos/' . $imageName;
                    //Upload the Image
                    Image::make($image_tmp)->save($imagePath);
                }
            } else if (!empty($data['current_admin_image'])) {
                $imageName = $data['current_admin_image'];
            } else {
                $imageName = "";
            }
            //Update Admin Details
            Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['admin_name'], 'mobile' => $data['admin_mobile'], 'image' => $imageName]);
            return redirect()->back()->with('success_message', 'Admin details updated successfully!');
        }
        return view('admin.settings.update_admin_details');
    }

    public function updateVendorDetails($slug, Request $request)
    {
        if ($slug == "personal") {
            Session::put('page', 'update_personal_details');
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'vendor_name' => 'required|regex:/^[\pL\s\-\d]+$/u',
                    'vendor_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'vendor_mobile' => 'required|numeric',
                ];
                $customMessages = [
                    'vendor_name.required' => 'Name is required',
                    'vendor_city.required' => 'Name is required',
                    'vendor_name.regex' => 'Valid Name is required',
                    'vendor_city.regex' => 'Valid City is required',
                    'vendor_mobile.required' => 'Mobile is required',
                    'vendor_mobile.numeric' => 'Valid Mobile is required',
                ];
                $this->validate($request, $rules, $customMessages);
                //Upload Vendor Photo
                if ($request->hasFile('vendor_image')) {
                    $image_tmp = $request->file('vendor_image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image Name
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/images/photos/' . $imageName;
                        //Upload the Image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_vendor_image'])) {
                    $imageName = $data['current_vendor_image'];
                } else {
                    $imageName = "";
                }
                //Update in admins table
                Admin::where('id', Auth::guard('admin')->user()->id)->update(['name' => $data['vendor_name'], 'mobile' => $data['vendor_mobile'], 'image' => $imageName]);
                //Update in vendirs table
                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update(['name' => $data['vendor_name'], 'mobile' => $data['vendor_mobile'], 'address' => $data['vendor_address'], 'city' => $data['vendor_city'], 'state' => $data['vendor_state'],
                'country' => $data['vendor_country'], 'pincode' => $data['vendor_pincode']]);
                return redirect()->back()->with('success_message', 'Vendor details updated successfully!');
            }
            $vendorDetails = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
        } else if ($slug == "business") {
            Session::put('page', 'update_business_details');
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'shop_name' => 'required|regex:/^[\pL\s\-\d]+$/u',
                    'shop_city' => 'required|regex:/^[\pL\s\-]+$/u',
                    'shop_mobile' => 'required|numeric',
                    'address_proof' => 'required',
                ];
                $customMessages = [
                    'shop_name.required' => 'Name is required',
                    'shop_city.required' => 'Name is required',
                    'shop_name.regex' => 'Valid Name is required',
                    'shop_city.regex' => 'Valid City is required',
                    'shop_mobile.required' => 'Mobile is required',
                    'shop_mobile.numeric' => 'Valid Mobile is required',
                ];
                $this->validate($request, $rules, $customMessages);
                //Upload Admin Photo
                if ($request->hasFile('address_proof_image')) {
                    $image_tmp = $request->file('address_proof_image');
                    if ($image_tmp->isValid()) {
                        //Get Image Extension
                        $extension = $image_tmp->getClientOriginalExtension();
                        //Generate New Image Name
                        $imageName = rand(111, 99999) . '.' . $extension;
                        $imagePath = 'admin/images/proofs/' . $imageName;
                        //Upload the Image
                        Image::make($image_tmp)->save($imagePath);
                    }
                } else if (!empty($data['current_address_proof'])) {
                    $imageName = $data['current_address_proof'];
                } else {
                    $imageName = "";
                }
                $vendorCount = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
                if($vendorCount>0){
                    //Update in vendors_business_details table
                    VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                        'shop_name' => $data['shop_name'], 'shop_mobile' => $data['shop_mobile'], 'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'], 'shop_state' => $data['shop_state'], 'shop_country' => $data['shop_country'], 'shop_pincode' => $data['shop_pincode'], 'business_license_number' => $data['business_license_number'], 'gst_number' => $data['gst_number'], 'pan_number' => $data['pan_number'],
                        'address_proof' => $data['address_proof'],
                        'address_proof_image' => $imageName
                    ]);
                }else{
                    //Update in vendors_business_details table
                    VendorsBusinessDetail::insert(['vendor_id'=>Auth::guard('admin')->user()->vendor_id,
                        'shop_name' => $data['shop_name'], 'shop_mobile' => $data['shop_mobile'], 'shop_address' => $data['shop_address'], 'shop_city' => $data['shop_city'], 'shop_state' => $data['shop_state'], 'shop_country' => $data['shop_country'], 'shop_pincode' => $data['shop_pincode'], 'business_license_number' => $data['business_license_number'], 'gst_number' => $data['gst_number'], 'pan_number' => $data['pan_number'],
                        'address_proof' => $data['address_proof'],
                        'address_proof_image' => $imageName
                    ]);
                }
                
                return redirect()->back()->with('success_message', 'Vendor details updated successfully!');
            }
            $vendorCount = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
            if($vendorCount>0){
                $vendorDetails = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            }else{
                $vendorDetails = array();
            }
            // dd($vendorDetails);
        } else if ($slug == "bank") {
            Session::put('page', 'update_bank_details');
            if ($request->isMethod('post')) {
                $data = $request->all();
                $rules = [
                    'account_holder_name' => 'required|regex:/^[\pL\s\-]+$/u',
                    'bank_name' => 'required',
                    'account_number' => 'required|numeric',
                    'bank_ifsc_code' => 'required',
                ];
                $customMessages = [
                    'account_holder_name.required' => 'Account Holder Name is required',
                    'account_holder_name.regex' => 'Valid Account Holder Name is required',
                    'bank_name.required' => 'Bank Name is required',
                    'account_number.required' => 'Account Number is required',
                    'account_number.numeric' => 'Valid Account Number is required',
                    'bank_ifsc_code.required' => 'Bank IFSC Code is required',
                ];
                $this->validate($request, $rules, $customMessages);
                $vendorCount = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
                if ($vendorCount > 0) {
                //Update in vendors_business_details table
                VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->update([
                    'account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'], 'account_number' => $data['account_number'], 'bank_ifsc_code' => $data['bank_ifsc_code']
                ]);
            }else{
                    VendorsBankDetail::insert(['vendor_id'=>Auth::guard('admin')->user()->vendor_id,
                        'account_holder_name' => $data['account_holder_name'], 'bank_name' => $data['bank_name'], 'account_number' => $data['account_number'], 'bank_ifsc_code' => $data['bank_ifsc_code']
                    ]);
            }
                return redirect()->back()->with('success_message', 'Vendor details updated successfully!');
            }
            $vendorCount = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->count();
            if ($vendorCount > 0) {
                $vendorDetails = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
            } else {
                $vendorDetails = array();
            }
        }
        $countries = Country::where('status',1)->get()->toArray();
        return view('admin.settings.update_vendor_details')->with(compact('slug', 'vendorDetails','countries'));
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //  echo "<pre>"; print_r($data); die;


            //Adding Custom Validation
            $rules = [
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];

            $customMessages = [
                'email.required' => 'Email is required',
                'email.email' => 'Valid Email is required',
                'password.required' => 'Password is required',
            ];

            $this->validate($request, $rules, $customMessages);

            // if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
            //     return redirect('admin/dashboard');
            // } else {
            //     return redirect()->back()->with('error_message', 'Invalid Email Or Password');
            // }
            if (Auth::guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password']])) {
                if(Auth::guard('admin')->user()->type=="vendor" && Auth::guard('admin')->user()->confirm=="No"){
                    return redirect()->back()->with('error_message','Please confirm your email to activate your Vendor Account');
                }
                else if (Auth::guard('admin')->user()->type != "vendor" && Auth::guard('admin')->user()->status == "0") {
                    return redirect()->back()->with('error_message', 'Your admin account is not active');
                }else{
                    return redirect('admin/dashboard');
                }
            } else {
                return redirect()->back()->with('error_message', 'Invalid Email Or Password');
            }
        }
        return view('admin.login');
    }
    public function admins($type = null)
    {
        $admins = Admin::query();
        if (!empty($type)) {
            $admins = $admins->where('type', $type);
            $title = ucfirst($type) . "s";
            Session::put('page', 'view_' . strtolower($title));
        } else {
            $title = "Admins/Subadmins/Vendors";
            Session::put('page', 'view_all');
        }
        $admins = $admins->get()->toArray();
        //dd($admins);
        return view('admin.admins.admins')->with(compact('admins', 'title'));
    }

    public function viewVendorDetails($id)
    {
        $vendorDetails = Admin::with('vendorPersonal', 'vendorBusiness', 'vendorBank')->where('id', $id)->first();
        $vendorDetails = json_decode(json_encode($vendorDetails), true);
        //   dd($vendorDetails);
        return view('admin.admins.view_vendor_details')->with(compact('vendorDetails'));
    }

    public function updateAdminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            if ($data['status'] == "Active") {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where('id', $data['admin_id'])->update(['status' => $status]);
            $adminDetails = Admin::where('id', $data['admin_id'])->first()->toArray();
            if($adminDetails['type']=="vendor" && $status==1){
                //Send Approval Email
                Vendor::where('id',$adminDetails['vendor_id'])->update(['status' => $status]);
                $email = $adminDetails['email'];
                $messageData = [
                    'email' => $adminDetails['email'],
                    'name' => $adminDetails['name'],
                    'mobile' => $adminDetails['mobile']
                ];

                Mail::send('emails.vendor_approved', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Vendor Account is Approved');
                });
            }

            return response()->json(['status' => $status, 'admin_id' => $data['admin_id']]);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}
