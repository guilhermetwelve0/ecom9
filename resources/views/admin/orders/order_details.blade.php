<?php

use App\Models\Product; ?>
@extends('admin.layout.layout')
@section('content')
<div class="main-panel">
    <div class="content-wrapper">
        @if(Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success:</strong> {{Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @endif
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Order Details</h3>
                        <h6 class="font-weight-normal mb-0"><a href="{{url('admin/orders')}}">Back to Orders</a></h6>
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
                        <h4 class="card-title">Order Details</h4>
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Order Id: </label>
                            <label>#{{$orderDetails['id']}}</label>
                        </div>
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Order Date: </label>
                            <label><?php
                                    date_default_timezone_set('America/Sao_Paulo'); // Definindo o fuso horário para Horário de Brasília

                                    $dataOriginal = $orderDetails['created_at']; // Substitua isso pelo valor real da data
                                    $dataFormatada = date('Y-m-d H:i:s', strtotime($dataOriginal));

                                    echo $dataFormatada;
                                    ?></label>
                        </div>
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Order Status: </label>
                            <label>{{$orderDetails['order_status']}}</label>
                        </div>
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Total Discount: </label>
                            <label>{{$orderDetails['total_discount']}}</label>
                        </div>
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Order Total: </label>
                            <label>Rs.{{$orderDetails['grand_total']}}</label>
                        </div>
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Shipping Charges: </label>
                            <label>Rs.{{$orderDetails['shipping_charges']}}</label>
                        </div>
                        @if(!empty($orderDetails['coupon_code']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Coupon Code: </label>
                            <label>{{$orderDetails['coupon_code']}}</label>
                        </div>
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Coupon Amount: </label>
                            <label>Rs.{{$orderDetails['coupon_amount']}}</label>
                        </div>
                        @endif
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Payment Method: </label>
                            <label>{{$orderDetails['payment_method']}}</label>
                        </div>
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Payment Gateway: </label>
                            <label>{{$orderDetails['payment_gateway']}}</label>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Customer Details</h4>
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Name:</label>
                            <label>{{$userDetails['name']}}</label>
                        </div>
                        @if(!empty($userDetails['address']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Address:</label>
                            <label>{{$userDetails['address']}}</label>
                        </div>
                        @endif
                        @if(!empty($userDetails['city']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">City:</label>
                            <label>{{$userDetails['city']}}</label>
                        </div>
                        @endif
                        @if(!empty($userDetails['state']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">State:</label>
                            <label>{{$userDetails['state']}}</label>
                        </div>
                        @endif
                        @if(!empty($userDetails['country']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Country:</label>
                            <label>{{$userDetails['country']}}</label>
                        </div>
                        @endif
                        @if(!empty($userDetails['pincode']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Pincode:</label>
                            <label>{{$userDetails['pincode']}}</label>
                        </div>
                        @endif
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Mobile:</label>
                            <label>{{$userDetails['mobile']}}</label>
                        </div>
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Email:</label>
                            <label>{{$userDetails['email']}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Delivery Address</h4>

                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Name:</label>
                            <label>{{$orderDetails['name']}}</label>
                        </div>
                        @if(!empty($orderDetails['address']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Address:</label>
                            <label>{{$orderDetails['address']}}</label>
                        </div>
                        @endif
                        @if(!empty($orderDetails['city']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">City:</label>
                            <label>{{$orderDetails['city']}}</label>
                        </div>
                        @endif
                        @if(!empty($orderDetails['state']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">State:</label>
                            <label>{{$orderDetails['state']}}</label>
                        </div>
                        @endif
                        @if(!empty($orderDetails['country']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Country:</label>
                            <label>{{$orderDetails['country']}}</label>
                        </div>
                        @endif
                        @if(!empty($orderDetails['pincode']))
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Pincode:</label>
                            <label>{{$orderDetails['pincode']}}</label>
                        </div>
                        @endif
                        <div class="form-group" style="height: 15px;">
                            <label style="font-weight: 550;">Mobile:</label>
                            <label>{{$orderDetails['mobile']}}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Update Order State</h4>
                        @if (Auth::guard('admin')->user()->type!="vendor")
                        <form action="{{url('admin/update-order-status')}}" method="post">@csrf
                            <input type="hidden" name="order_id" value="{{$orderDetails['id']}}">
                            <select name="order_status" id="order_status" required="">
                                <option value="" selected="">Select</option>
                                @foreach($orderStatuses as $status)
                                <option value="{{$status['name']}}" @if(!empty($orderDetails['order_status']) && $orderDetails['order_status']==$status['name']) selected="" @endif>{{$status['name']}}</option>
                                @endforeach
                            </select>
                            <input type="text" name="courier_name" id="courier_name" placeholder="Courier Name">
                            <input type="text" name="tracking_number" id="tracking_number" placeholder="Tracking Number">
                            <button type="submit">Update</button>
                        </form>
                        <br>
                        @foreach($orderLog as $key => $log)
                        <strong>{{$log['order_status']}}</strong>
                        @if($log['order_status']=="Shipped")
                        @if(isset($log['orders_products'][$key]['product_code']))
                        - for item {{$log['orders_products'][$key]['product_code']}}
                        @if(!empty($log['orders_products'][$key]['courier_name']))
                        <br><span>Courier Name: {{$log['orders_products'][$key]['courier_name']}}</span>
                        @endif
                        @if(!empty($log['orders_products'][$key]['tracking_number']))
                        <br><span>Tracking Number: {{$log['orders_products'][$key]['tracking_number']}}</span>
                        @endif
                        @else
                        @if(!empty($orderDetails['courier_name']))
                        <br><span>Courier Name: {{$orderDetails['courier_name']}}</span>
                        @endif
                        @if(!empty($orderDetails['tracking_number']))
                        <br><span>Tracking Number: {{$orderDetails['tracking_number']}}</span>
                        @endif
                        @endif
                        @endif
                        <br>
                        <?php
                        date_default_timezone_set('America/Sao_Paulo'); // Definindo o fuso horário para Horário de Brasília
                        $dataOriginal = $log['created_at']; // Substitua isso pelo valor real da data
                        $dataFormatada = date('Y-m-d H:i:s', strtotime($dataOriginal));
                        echo $dataFormatada;
                        ?><br>
                        <hr>
                        @endforeach
                        @else
                        This feature is restricted.
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ordered Products</h4>
                        <table class="table table-striped table-borderless">
                            <tr>
                            </tr>
                            <tr class="table-danger">
                                <th>Product Image</th>
                                <th>Product Code</th>
                                <th>Product Name</th>
                                <th>Product Size</th>
                                <th>Product Color</th>
                                <th>Product Qty</th>
                                <th>Item Status</th>
                            </tr>
                            @foreach($orderDetails['orders_products'] as $product)
                            <tr>
                                <td>
                                    @php $getProductImage = Product::getProductImage($product['product_id']) @endphp
                                    <a target="_blank" href="{{url('product/'.$product['product_id'])}}"><img src="{{asset('front/images/product_images/small/'.$getProductImage)}}"></a>
                                </td>
                                <td>{{$product['product_code']}}</td>
                                <td>{{$product['product_name']}}</td>
                                <td>{{$product['product_size']}}</td>
                                <td>{{$product['product_color']}}</td>
                                <td>{{$product['product_qty']}}</td>
                                <td>
                                    <form action="{{url('admin/update-order-item-status')}}" method="post">@csrf
                                        <input type="hidden" name="order_item_id" value="{{$product['id']}}">
                                        <select name="order_item_status" id="order_item_status" required="">
                                            <option value="">Select</option>
                                            @foreach($orderItemStatuses as $status)
                                            <option value="{{$status['name']}}" @if(!empty($product['item_status']) && $product['item_status']==$status['name']) selected="" @endif>{{$status['name']}}</option>
                                            @endforeach
                                        </select>
                                        <input style="width:110px;" type="text" name="item_courier_name" id="item_courier_name" placeholder="Courier Name" @if(!empty($product['courier_name'])) value="{{$product['courier_name']}}" @endif>
                                        <input style="width:110px;" type="text" name="item_tracking_number" id="item_tracking_number" placeholder="Tracking Number" @if(!empty($product['tracking_number'])) value="{{$product['tracking_number']}}" @endif>
                                        <button type="submit">Update</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </table>

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