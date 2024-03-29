<?php

namespace App\Http\Controllers\Front;

use App\Models\Country;
use App\Models\DeliveryAddress;
use App\Models\Order;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OrdersProduct;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsFilter;
use App\Models\Vendor;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ProductsController extends Controller
{
    public function listing(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die;
            $url = $data['url'];
            $_GET['sort'] = $data['sort'];
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                //Get Category Details
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);



                //Checking for Dynamic Filters
                $productFilters = ProductsFilter::productFilters();
                foreach ($productFilters as $key => $filter) {
                    //If filter is selected
                    if (isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])) {
                        $categoryProducts->whereIn($filter['filter_column'], $data[$filter['filter_column']]);
                    }
                }
                //checking for Sort
                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == "product_latest") {
                        $categoryProducts->orderby('products.id', 'Desc');
                    } else if ($_GET['sort'] == "price_lowest") {
                        $categoryProducts->orderby('products.product_price', 'Asc');
                    } else if ($_GET['sort'] == "price_highest") {
                        $categoryProducts->orderby('products.product_price', 'Desc');
                    } else if ($_GET['sort'] == "name_z_a") {
                        $categoryProducts->orderby('products.product_name', 'Desc');
                    } else if ($_GET['sort'] == "name_a_z") {
                        $categoryProducts->orderby('products.product_name', 'Asc');
                    }
                }

                //checking for Size
                if (isset($data['size']) && !empty($data['size'])) {
                    $productIds = ProductsAttribute::select('product_id')->whereIn('size', $data['size'])->pluck('product_id')->toArray();
                    $categoryProducts->whereIn('products.id', $productIds);
                }

                //checking for Color
                if (isset($data['color']) && !empty($data['color'])) {
                    $productIds = Product::select('id')->whereIn('product_color', $data['color'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('products.id', $productIds);
                }

                //checking for Price
                $productsIds = array();
                if (isset($data['price']) && !empty($data['price'])) {
                    foreach ($data['price'] as $key => $price) {
                        $priceArr = explode("-", $price);
                        if (isset($priceArr[0]) && isset($priceArr[1])) {
                            $productIds[] = Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
                        }
                    }
                    $productIds = array_unique(array_flatten($productIds));
                    $categoryProducts->whereIn('products.id', $productIds);
                }
                // //checking for Price
                // if (isset($data['price']) && !empty($data['price'])) {
                //     foreach ($data['price'] as $key => $price) {
                //         $priceArr = explode("-", $price);
                //         $productIds[] = Product::select('id')->whereBetween('product_price', [$priceArr[0], $priceArr[1]])->pluck('id')->toArray();
                //     }
                //     $productIds = call_user_func_array('array_merge', $productIds);
                //     $categoryProducts->whereIn('products.id', $productIds);
                // }

                //checking for Brand
                if (isset($data['brand']) && !empty($data['brand'])) {
                    $productIds = Product::select('id')->whereIn('brand_id', $data['brand'])->pluck('id')->toArray();
                    $categoryProducts->whereIn('products.id', $productIds);
                }

                $categoryProducts = $categoryProducts->paginate(10);
                // dd($categoryDetails);
                // echo "Category exists"; die;
                return view('front.products.ajax_products_listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        } else {
            $url = Route::getFacadeRoot()->current()->uri();
            $categoryCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($categoryCount > 0) {
                //Get Category Details
                $categoryDetails = Category::categoryDetails($url);
                $categoryProducts = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);


                //checking for Sort
                if (isset($_GET['sort']) && !empty($_GET['sort'])) {
                    if ($_GET['sort'] == "product_latest") {
                        $categoryProducts->orderby('products.id', 'Desc');
                    } else if ($_GET['sort'] == "price_lowest") {
                        $categoryProducts->orderby('products.product_price', 'Asc');
                    } else if ($_GET['sort'] == "price_highest") {
                        $categoryProducts->orderby('products.product_price', 'Desc');
                    } else if ($_GET['sort'] == "name_z_a") {
                        $categoryProducts->orderby('products.product_name', 'Desc');
                    } else if ($_GET['sort'] == "name_a_z") {
                        $categoryProducts->orderby('products.product_name', 'Asc');
                    }
                }

                $categoryProducts = $categoryProducts->paginate(10);
                // dd($categoryDetails);
                // echo "Category exists"; die;
                return view('front.products.listing')->with(compact('categoryDetails', 'categoryProducts', 'url'));
            } else {
                abort(404);
            }
        }
    }
    public function vendorListing($vendorid)
    {
        //Get Vendor Shop Name
        $getVendorShop = Vendor::getVendorShop($vendorid);
        //Get Vendor Products
        $vendorProducts = Product::with('brand')->where('vendor_id', $vendorid)->where('status', 1);
        $vendorProducts = $vendorProducts->paginate(30);
        return view('front.products.vendor_listing')->with(compact('getVendorShop', 'vendorProducts'));
    }

    public function detail($id)
    {
        $productDetails = Product::with(['section', 'category', 'brand', 'attributes' => function ($query) {
            $query->where('stock', '>', 0)->where('status', 1);
        }, 'images', 'vendor'])->find($id)->toArray();
        $categoryDetails = Category::categoryDetails($productDetails['category']['url']);
        // dd($productDetails);
        //Get Similar Products
        $similarProducts = Product::with('brand')->where('category_id', $productDetails['category']['id'])->where('id', '!=', $id)->limit(4)->inRandomOrder()->get()->toArray();
        // dd($similarProducts);
        //Set Session for Recently Viewed Products
        if (empty(Session::get('session_id'))) {
            $session_id = md5(uniqid(mt_rand(), true));
        } else {
            $session_id = Session::get('session_id');
        }

        Session::put('session_id', $session_id);

        // Insert product in table if not already exists
        $countRecentlyViewedProducts = DB::table('recently_viewed_products')->where(['product_id' => $id, 'session_id' => $session_id])->count();
        if ($countRecentlyViewedProducts == 0) {
            DB::table('recently_viewed_products')->insert(['product_id' => $id, 'session_id' => $session_id]);
        }

        //Get Recently Viewed Products Ids
        $recentProductsIds = DB::table('recently_viewed_products')->select('product_id')->where('product_id', '!=', $id)->where('session_id', $session_id)->inRandomOrder()->get()->take(4)->pluck('product_id');
        // dd($recentProductsIds);

        //Get Recently Viewed Products
        $recentlyViewedProducts = Product::with('brand')->whereIn('id', $recentProductsIds)->get()->toArray();
        // dd($recentlyViewedProducts);

        //Get Group Products (Product Colors)
        $groupProducts = array();
        if (!empty($productDetails['group_code'])) {
            $groupProducts = Product::select('id', 'product_image')->where('id', '!=', $id)->where([
                'group_code' => $productDetails['group_code'], 'status' => 1
            ])->get()->toArray();
            // dd($groupProducts);
        }


        $totalStock = ProductsAttribute::where('product_id', $id)->sum('stock');
        $quantitySold = OrdersProduct::where('product_id', $id)->sum('product_qty');
        $availableStock = $totalStock - $quantitySold;

        return view('front.products.detail')->with(compact('productDetails', 'availableStock', 'categoryDetails', 'totalStock', 'similarProducts', 'recentlyViewedProducts'));
    }

    public function getProductPrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //  echo "<pre>"; print_r($data); die;
            $getDiscountedAttrPrice = Product::getDiscountAttributePrice($data['product_id'], $data['size']);
            return $getDiscountedAttrPrice;
        }
    }

    public function cartAdd(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            //Check Product Stock is available or not
            $getProductStock = ProductsAttribute::getProductStock($data['product_id'], $data['size']);
            if ($getProductStock < $data['quantity']) {
                return redirect()->back()->with('error_message', 'Required Quantity is not available!');
            }

            //Generate Session Id if not exists
            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }

            //Check Product if already exists in the User Cart
            if (Auth::check()) {
                //User is logged in
                $user_id = Auth::user()->id;
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'user_id' => $user_id])->count();
            } else {
                //User is not logged in
                $user_id = 0;
                $countProducts = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'session_id' => $session_id])->count();
            }

            if ($countProducts > 0) {
                return redirect()->back()->with('error_message', 'Product already exists in Cart!');
            }

            // Save Product in carts table
            $item = new Cart;
            $item->session_id = $session_id;
            $item->user_id = $user_id;
            $item->product_id = $data['product_id'];
            $item->size = $data['size'];
            $item->quantity = $data['quantity'];
            $item->save();
            return redirect()->back()->with('success_message', 'Product has been added in Cart! <a  style="text-decoration:underline !important" href="/cart">View Cart</a>');
        }
    }

    public function cart()
    {
        $getCartItems = Cart::getCartItems();

        // dd($getCartItems);
        return view('front.products.cart')->with(compact('getCartItems'));
    }

    public function cartUpdate(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Get Cart Details
            $cartDetails = Cart::find($data['cartid']);

            // Get Available Product Stock
            $availableStock = ProductsAttribute::select('stock')->where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size']])->first()->toArray();

            // echo "<pre>"; print_r($availableStock); die;

            // Check if desired Stock from user is available
            if ($data['qty'] > $availableStock['stock']) {
                $getCartItems = Cart::getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product Stock is not available',
                    'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'headerview' => (string)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                ]);
            }

            // Check if product size is available
            $availableSize = ProductsAttribute::where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size'], 'status' => 1])->count();
            if ($availableSize == 0) {
                $getCartItems = Cart::getCartItems();
                return response()->json([
                    'status' => false,
                    'message' => 'Product Size is not available. Please remove this Product and choose another one!',
                    'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'headerview' => (string)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                ]);
            }

            // Update the Qty
            Cart::where('id', $data['cartid'])->update(['quantity' => $data['qty']]);
            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            Session::forget('couponAmount');
            Session::forget('couponCode');
            return response()->json([
                'status' => true,
                'totalCartItems' => $totalCartItems,
                'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                'headerview' => (string)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
            ]);
        }
    }

    public function cartDelete(Request $request)
    {
        if ($request->ajax()) {
            Session::forget('couponAmount');
            Session::forget('couponCode');
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            Cart::where('id', $data['cartid'])->delete();
            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            return response()->json([
                'totalCartItems' => $totalCartItems,
                'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                'headerview' => (string)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))

            ]);
        }
    }
    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            Session::forget('couponAmount');
            Session::forget('couponCode');
            // echo "<pre>"; print_r($getCartItems); die;
            $getCartItems = Cart::getCartItems();
            $totalCartItems = totalCartItems();
            $couponCount = Coupon::where('coupon_code', $data['code'])->count();
            if ($couponCount == 0) {
                return response()->json([
                    'status' => false,
                    'totalCartItems' => $totalCartItems,
                    'message' => 'This coupon is not valid!',
                    'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                    'headerview' => (string)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                ]);
            } else {
                //Check for other conditions

                // Get Coupon Details
                $couponDetails = Coupon::where('coupon_code', $data['code'])->first();

                // Check if coupon is active
                if ($couponDetails->status == 0) {
                    $message = "The coupon is not active!";
                }

                //Check if coupon is expired
                $expiry_date = $couponDetails->expiry_date;
                $current_date = date('Y-m-d');
                if ($expiry_date < $current_date) {
                    $message = "The coupon is expired!";
                }

                // Check if coupon is from selected categories
                // Get all selected categories from coupon and convert to array
                $catArr = explode(',', $couponDetails->categories);

                //Check if any cart item not belong to coupon category
                $total_amount = 0;
                foreach ($getCartItems as $key => $item) {
                    if (!in_array($item['product']['category_id'], $catArr)) {
                        $message = "This coupon is not for one of the selected products.";
                    }
                    $attrPrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                    // echo "<pre>"; print_r($attrPrice); die;
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
                }

                //Check if coupon is from selected users
                // Get all selected users from coupon and convert to array
                if (isset($couponDetails->users) && !empty($couponDetails->users)) {
                    $usersArr = explode(",", $couponDetails->users);
                    if (count($usersArr)) {
                        //Get User Id's of all selected users
                        foreach ($usersArr as $key => $user) {
                            $getUserId = User::select('id')->where('email', $user)->first();
                            if ($getUserId) {
                                $usersId[] = $getUserId->id;
                            }
                        }

                        //Check if any cart item not belong to coupon user
                        foreach ($getCartItems as $key => $item) {
                            if (!in_array($item['user_id'], $usersId)) {
                                $message = "This coupon is not for you. Try with valid coupon code!";
                            }
                        }
                    }
                }


                if ($couponDetails->vendor_id > 0) {
                    $productIds = Product::select('id')->where('vendor_id', $couponDetails->vendor_id)->pluck('id')->toArray();
                    //Check if coupon belongs to Vendor Products
                    foreach ($getCartItems as $key => $item) {
                        if (!in_array($item['product']['id'], $productIds)) {
                            $message = "This coupon is not for you. Try with valid coupon code!";
                        }
                    }
                }



                // If error message is there
                if (isset($message)) {
                    return response()->json([
                        'status' => false,
                        'totalCartItems' => $totalCartItems,
                        'message' => $message,
                        'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                        'headerview' => (string)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                    ]);
                } else {
                    //Coupon code is correct

                    //Check if Coupon Amount type is Fixed or Percentage
                    if ($couponDetails->amount_type == "Fixed") {
                        $couponAmount = $couponDetails->amount;
                    } else {
                        $couponAmount = $total_amount * ($couponDetails->amount / 100);
                    }

                    $grand_total = $total_amount - $couponAmount;

                    // Add Coupon Code & Amount in Session Variables
                    Session::put('couponAmount', $couponAmount);
                    Session::put('couponCode', $data['code']);

                    $message = "Coupon Code sucessfully applied. You are availing discount!";

                    return response()->json([
                        'status' => true,
                        'totalCartItems' => $totalCartItems,
                        'couponAmount' => $couponAmount,
                        'grand_total' => $grand_total,
                        'message' => $message,
                        'view' => (string)View::make('front.products.cart_items')->with(compact('getCartItems')),
                        'headerview' => (string)View::make('front.layout.header_cart_items')->with(compact('getCartItems'))
                    ]);
                }
            }
        }
    }
    public function checkout(Request $request)
    {
        $deliveryAddresses = DeliveryAddress::deliveryAddresses();
        $countries = Country::where('status', 1)->get()->toArray();
        $getCartItems = Cart::getCartItems();
        // dd($getCartItems);

        if (count($getCartItems) == 0) {
            $message = "Shopping Cart is empty! Please add products to checkout";
            return redirect('cart')->with('error_message', $message);
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            //Delivery Address Validation
            if (empty($data['address_id'])) {
                $message = "Please select Delivery Address!";
                return redirect()->back()->with('error_message', $message);
            }
            //Payment Method Validation
            if (empty($data['payment_gateway'])) {
                $message = "Please select Payment Method!";
                return redirect()->back()->with('error_message', $message);
            }
            //Agree to T&C Validation
            if (empty($data['accept'])) {
                $message = "Please agree to T&C!";
                return redirect()->back()->with('error_message', $message);
            }
            // echo "<pre>"; print_r($data); die;
            //Get Delivery Address from address_id
            $deliveryAddress = DeliveryAddress::where('id', $data['address_id'])->first()->toArray();
            $totalDiscount = 0;
            // dd($deliveryAddress);
            //Set Payment Method as COD if selected from user otherwise set as Prepaid
            if ($data['payment_gateway'] == "COD") {
                $payment_method = "COD";
                $order_status = "New";
            } else {
                $payment_method = "Prepaid";
                $order_status = "Pending";
            }
            DB::beginTransaction();
            //Fetch Order Total Price
            //Calculate Grand total
            $total_price = 0;
            $totalDiscount = 0; // Inicialize o totalDiscount aqui
            foreach ($getCartItems as $item) {
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                $itemTotal = $getDiscountAttributePrice['final_price'] * $item['quantity'];
                $total_price += $itemTotal;
                // Calcule o desconto do produto e adicione ao totalDiscount
                $productTotalDiscount = ($getDiscountAttributePrice['product_price'] - $getDiscountAttributePrice['final_price']) * $item['quantity'];
                $totalDiscount += $productTotalDiscount;
            }

            //Calculate Shipping Charges
            $shipping_charges = 0;
            //Calculate Grand Total
             $grand_total = $total_price + $shipping_charges - Session::get('couponAmount');
            // $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
            // $productTotalDiscount = ($getDiscountAttributePrice['product_price'] - $getDiscountAttributePrice['final_price']) * $item['quantity'];
            //  $totalDiscount += $productTotalDiscount;



            //Insert Grand Total in Session Variable
            Session::put('grand_total', $grand_total);
            //Insert Order Details
            $order = new Order;
            $order->user_id = Auth::user()->id;
            $order->name = $deliveryAddress['name'];
            $order->address = $deliveryAddress['address'];
            $order->city = $deliveryAddress['city'];
            $order->state = $deliveryAddress['state'];
            $order->country = $deliveryAddress['country'];
            $order->pincode = $deliveryAddress['pincode'];
            $order->mobile = $deliveryAddress['mobile'];
            $order->email = Auth::user()->email;
            $order->shipping_charges = $shipping_charges;
            $order->coupon_code = Session::get('couponCode');
            $order->coupon_amount = Session::get('couponAmount');
            $order->order_status = $order_status;
            $order->total_discount = $totalDiscount;
            $order->payment_method = $payment_method;
            $order->payment_gateway = $data['payment_gateway'];
            $order->grand_total = $grand_total;
            $order->save();
            $order_id = DB::getPdo()->lastInsertId();
            foreach ($getCartItems as $item) {
                $cartItem = new OrdersProduct;
                $cartItem->order_id = $order_id;
                $cartItem->user_id = Auth::user()->id;
                $getProductDetails = Product::select('product_code', 'product_name', 'product_color', 'admin_id', 'vendor_id')->where('id', $item['product_id'])->first()->toArray();
                // dd($getProductDetails);
                $cartItem->admin_id = $getProductDetails['admin_id'];
                $cartItem->vendor_id = $getProductDetails['vendor_id'];
                $cartItem->product_id = $item['product_id'];
                $cartItem->product_code = $getProductDetails['product_code'];
                $cartItem->product_name = $getProductDetails['product_name'];
                $cartItem->product_color = $getProductDetails['product_color'];
                $cartItem->product_size = $item['size'];
                $getDiscountAttributePrice = Product::getDiscountAttributePrice($item['product_id'], $item['size']);
                $cartItem->product_price = $getDiscountAttributePrice['final_price'];
                $cartItem->product_qty = $item['quantity'];
                $cartItem->save();
            }
            //Insert Order Id in Session variable
            Session::put('order_id', $order_id);
            DB::commit();
            $orderDetails = Order::with('orders_products')->where('id',$order_id)->first()->toArray();
            if($data['payment_gateway']=="COD"){
                //Send Order Email
                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    'name' => Auth::user()->name,
                    'order_id' => $order_id,
                    'orderDetails' => $orderDetails
                ];
                Mail::send('emails.order',$messageData,function($message)use($email){
                    $message->to($email)->subject('Order Placed - StackDevelopers.in');
                });
                //Send Order SMS
            }else{
                echo "Prepaid payment methods coming soon";
            }
            return redirect('thanks');
        }

        return view('front.products.checkout')->with(compact('deliveryAddresses', 'countries', 'getCartItems'));
    }
    public function thanks(){
        if(Session::has('order_id')){
            //Empty the cart
            Cart::where('user_id',Auth::user()->id)->delete();
            return view('front.products.thanks');
        }else{
            return redirect('cart');
        }
    }
}
