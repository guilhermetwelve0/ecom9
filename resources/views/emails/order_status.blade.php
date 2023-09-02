<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <table style="width:700px;">
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><img src="{{asset('front/images/main-logo/stack-developers-logo.png') }}"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Hello {{$name}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Your Order #{{$order_id}} status has been updated to {{$order_status}}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Your Order details are as below: </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table style="width:95%" cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                    <tr bgcolor="#cccccc">
                        <td>Product Name</td>
                        <td>Product Code</td>
                        <td>Product Size</td>
                        <td>Product Color</td>
                        <td>Product Quantity</td>
                        <td>Product Price</td>
                    </tr>
                    @if(isset($orderDetails) && is_array($orderDetails['orders_products']))
                    @foreach($orderDetails['orders_products'] as $order)
                    <tr bgcolor="#f9f9f9">
                        <td>{{$order['product_name']}}</td>
                        <td>{{$order['product_code']}}</td>
                        <td>{{$order['product_size']}}</td>
                        <td>{{$order['product_color']}}</td>
                        <td>{{$order['product_qty']}}</td>
                        <td>{{$order['product_price']}}</td>
                    </tr>
                    @endforeach
                    @endif
                    @if(isset($orderDetails))
                    <tr>
                        <td colspan="5" align="right">Shipping Charges</td>
                        <td>INR {{$orderDetails['shipping_charges']}}</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Coupon Discount</td>
                        <td>INR
                            @if($orderDetails['coupon_amount']>0)
                            {{$orderDetails['coupon_amount']}}
                        </td>
                        @else
                        0
                        @endif
                    </tr>
                    <tr>
                        @if(!empty($orderDetails['coupon_code']))
                        <td colspan="5" align="right">Coupon Code</td>
                        <td>{{$orderDetails['coupon_code']}}</td>
                        @endif
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Grand Total</td>
                        <td>INR {{$orderDetails['grand_total']}}</td>
                    </tr>
                    <tr>
                        <td colspan="5" align="right">Total Discount</td>
                        <td>INR {{$orderDetails['total_discount']}}</td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>
                <table>
                    @if(isset($orderDetails))
                    <tr>
                        <td><strong>Delivery Address:-</strong></td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['name']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['address']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['city']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['state']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['country']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['pincode']}}</td>
                    </tr>
                    <tr>
                        <td>{{$orderDetails['mobile']}}</td>
                    </tr>
                    @endif
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>For any queries, you can contact us at <a href="mailto:info@stackdevelopers.in">info@stackdevelopers.in</a></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>Regards,<br>Team Stack Developers</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>

    </table>
</body>

</html>