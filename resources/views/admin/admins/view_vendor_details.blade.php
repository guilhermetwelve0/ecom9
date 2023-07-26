@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Vendor Details</h3>
                        <h6 class="font-weight-normal mb-0"><a href="{{url('admin/admins/vendor')}}">Back to Vendors</a></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Personal Information</h4>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" value="{{$vendorDetails['vendor_personal']['email']}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_name">Name</label>
                            <input type="text" class="form-control" value="{{$vendorDetails['vendor_personal']['name']}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_address">Address</label>
                            <input type="text" class="form-control" value="{{$vendorDetails['vendor_personal']['address']}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_city">City</label>
                            <input type="text" class="form-control" value="{{$vendorDetails['vendor_personal']['city']}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_state">State</label>
                            <input type="text" class="form-control" value="{{$vendorDetails['vendor_personal']['state']}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_country">Country</label>
                            <input type="text" class="form-control" value="{{$vendorDetails['vendor_personal']['country']}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_pincode">Pincode</label>
                            <input type="text" class="form-control" value="{{$vendorDetails['vendor_personal']['pincode']}}" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_mobile">Mobile</label>
                            <input type="text" class="form-control" value="{{$vendorDetails['vendor_personal']['mobile']}}" readonly="">
                        </div>
                        @if(!empty($vendorDetails['image']))
                        <div class="form-group">
                            <label for="vendor_image">Photo</label>
                            <br>
                            @php
                            $imagePath = public_path('admin/images/photos/' . trim(Auth::guard('admin')->user()->image));
                            @endphp
                            @if(file_exists($imagePath))
                            <img style="width: 200px;" src="{{ url('admin/images/photos/' . $vendorDetails['image']) }}">
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Business Information</h4>
                        <div class="form-group">
                            <label for="vendor_name">Shop Name</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['shop_name'])) value="{{$vendorDetails['shop_name']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_address">Shop Address</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['shop_address'])) value="{{$vendorDetails['shop_address']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_city">Shop City</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['shop_city'])) value="{{$vendorDetails['shop_city']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_state">Shop State</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['shop_state'])) value="{{$vendorDetails['shop_state']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_country">Shop Country</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['shop_country'])) @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_pincode">Shop Pincode</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['shop_pincode'])) value="{{$vendorDetails['shop_pincode']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_mobile">Shop Mobile</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['shop_mobile'])) value="{{$vendorDetails['shop_mobile']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label>Shop Website</label>
                            <input class="form-control" @if(isset($vendorDetails['shop_website'])) value="{{$vendorDetails['shop_website']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label>Shop Email</label>
                            <input class="form-control" @if(isset($vendorDetails['shop_email'])) value="{{$vendorDetails['shop_email']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label>Address Proof</label>
                            <input class="form-control" @if(isset($vendorDetails['vendor_business']['address_proof'])))) value="{{$vendorDetails['vendor_business']['address_proof']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label>Business License Number</label>
                            <input class="form-control" @if(isset($vendorDetails['business_license_number'])) value="{{$vendorDetails['business_license_number']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label>GST Number</label>
                            <input class="form-control" @if(isset($vendorDetails['gst_number'])) value="{{$vendorDetails['gst_number']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label>Pan Number</label>
                            <input class="form-control" @if(isset($vendorDetails['pan_number'])) value="{{$vendorDetails['pan_number']}}" @endif readonly="">
                        </div>
                        @if(!empty($vendorDetails['image']))
                        <div class="form-group">
                            <label for="vendor_image">Photo</label>
                            <br>
                            @php
                            $addressProofImage = isset($vendorDetails['vendor_business']['address_proof_image']) ? $vendorDetails['vendor_business']['address_proof_image'] : null;
                            $imagePath = public_path('admin/images/proofs/' . trim($addressProofImage));
                            @endphp
                            @if(!empty($addressProofImage) && file_exists($imagePath))
                            <img style="width: 200px;" src="{{ url('admin/images/proofs/' . $addressProofImage) }}">
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Bank Information</h4>
                        <div class="form-group">
                            <label for="vendor_name">Account Holder Name</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['account_holder_name'])) value="{{$vendorDetails['account_holder_name']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_name">Bank Name</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['account_holder_name'])) value="{{$vendorDetails['bank_name']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_address">Account Number</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['account_holder_name'])) value="{{$vendorDetails['account_number']}}" @endif readonly="">
                        </div>
                        <div class="form-group">
                            <label for="vendor_city">IFSC Code</label>
                            <input type="text" class="form-control" @if(isset($vendorDetails['account_holder_name'])) value="{{$vendorDetails['bank_ifsc_code']}}" @endif readonly="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>
@endsection