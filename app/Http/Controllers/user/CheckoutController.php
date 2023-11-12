<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\admin\ShippingAddress;
use App\Models\SalesOrder;
use App\Models\ShippingAddress as ModelsShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;

class CheckoutController extends Controller
{
    function checkoutPage(){
        $userId = Session::get('user')->UserID;
        $shippingAddressDefault = ShippingAddress::where('UserID', $userId)->where('IsDefault', 1)->first();
        $shippingAddressList = ShippingAddress::where('UserID', $userId)->get();
        $userID = Auth::id();
        if($userID) {
            $cart = ShoppingCart::firstOrNew(['UserID' => $userID]);
            if (!$cart->CartID) {
                $cart->save();
            }
            $cartID = $cart->CartID;
            $cartItems = ShoppingCartDetail::with('book')->where('CartID', $cartID)->get();
            $totalPrice = 0;
            foreach ($cartItems as $cartItem) {
                $totalPrice += $cartItem->Quantity * $cartItem->book->CostPrice;
            }
        }
        $bookPrice = $totalPrice;
        if($shippingAddressDefault) {
            $totalPrice += 5;
            return view(
                "user.checkout-page", compact('shippingAddressDefault', 'totalPrice', 'bookPrice', 'shippingAddressList'));
        }
        return view(
            "user.checkout-page", compact('totalPrice', 'bookPrice')
        );
    }

    function checkoutConfirm(){
        $userID = Auth::id();
        if($userID) {
            $cart = ShoppingCart::firstOrNew(['UserID' => $userID]);
            if (!$cart->CartID) {
                $cart->save();
            }
            $cartID = $cart->CartID;
            $cartItems = ShoppingCartDetail::with('book')->where('CartID', $cartID)->get();
            $totalPrice = 0;
            foreach ($cartItems as $cartItem) {
                $totalPrice += $cartItem->Quantity * $cartItem->book->CostPrice;
            }
        }
        $address = ShippingAddress::firstOrNew(['UserID' => $userID]);
        $saleOrders['UserID'] = $userID;
        $saleOrders['OrderStatus'] = 'SHIPPING';
        $saleOrders['ShippingAddressID'] = $address->AddressID;
        // $saleOrders['Discount'] = 5;
        $saleOrders['TotalPrice'] = $totalPrice + 5 - 5;
        $saleOrders['ShippingFee'] = 5;
        $saleOrders['OrderDate'] = Carbon::now();
        $Order = SalesOrder::create($saleOrders);

        $mailData = [
            'title' => 'Đơn hàng mới vừa tạo',
            'body' => 'Thông báo gửi đơn',
            'email' => Session::get('user')->email,
            'cartItem' => $cartItems,
            'totalPrice' => $totalPrice + 5,
            'orderID' => $Order->OrderID,
        ];

        Mail::to(Session::get('user')->email)->send(new OrderMail($mailData));

        return view(
            "user.order-confirm",
            ['cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'orderID' => $Order->OrderID],
        );
    }
}
