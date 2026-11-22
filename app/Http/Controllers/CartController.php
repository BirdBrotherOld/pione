<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Kavist\RajaOngkir\Facades\RajaOngkir;

class CartController extends Controller
{
    public function index()
    {

        $carts = Cart::with(['event', 'product', 'user'])->where('user_id', auth()->user()->id)
            ->get();

        // if ($carts->event_id != null) {
        //     $carts->with(['event', 'user']);
        // } else {
        //     $carts->with(['product', 'user']);
        // }
        return view('pages.cart', [
            'carts' => $carts,
        ]);
    }

    public function addEvent(CartRequest $request, $id)
    {
        $cart = Cart::where('event_id', $id)->where('user_id', auth()->user()->id)->first();

        if ($cart) {
            $cart->increment('qty', $request->qty);
        } elseif ($request->event_id != null) {
            Cart::create([
                'event_id' => $id,
                'user_id' => auth()->user()->id,
                'qty' => $request->qty,
            ]);
        }
        return redirect()->route('cart');
    }

    public function addProduct(CartRequest $request, $id)
    {
        $cart = Cart::where('product_id', $id)->where('user_id', auth()->user()->id)->first();

        if ($cart) {
            $cart->increment('qty', $request->qty);
        } elseif ($request->product_id != null) {
            Cart::create([
                'product_id' => $id,
                'user_id' => auth()->user()->id,
                'qty' => $request->qty,
            ]);
        }
        return redirect()->route('cart');
    }
    
    public function destroy($id)
    {
        $cart = Cart::find($id);

        $cart->delete();
        Session::flash('success', "Item Successfully Delete!");
        return redirect()->route('cart');
    }

    public function deleteItem(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('event_id');
            if (Cart::where('event_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('event_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Cart Item Delete Succesfully"]);
            }
        } else {
            return response()->json(['status' => 'Login to Continue']);
        }
    }

    public function updateCart(Request $request){
        $prod_id = $request->input('event_id');
        $prod_qty = $request->input('qty');

        if (Auth::check()) {
            if (Cart::where('event_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('event_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart->qty = $prod_qty;
                $cart->update();
                return response()->json(['status' => "Quantity Updated"]);
            }
        } else {
            
            return response()->json(['status' => 'Login to Continue']);
        }
        
    }
    public function deleteProductItem(Request $request){
        if(Auth::check()){
            $prod_id = $request->input('product_id');
            if (Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cartItem = Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->first();
                $cartItem->delete();
                return response()->json(['status' => "Cart Item Delete Succesfully"]);
            }
        } else {
            return response()->json(['status' => 'Login to Continue']);
        }
    }

    public function updateProductCart(Request $request){
        $prod_id = $request->input('product_id');
        $prod_qty = $request->input('qty');

        if (Auth::check()) {
            if (Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->exists()) {
                $cart = Cart::where('product_id', $prod_id)->where('user_id', Auth::id())->first();
                $cart->qty = $prod_qty;
                $cart->update();
                return response()->json(['status' => "Quantity Updated"]);
            }
        } else {
            
            return response()->json(['status' => 'Login to Continue']);
        }
        
    }

    public function check_ongkir()
    {
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => Auth::user()->regencies_id, // ID kota/kabupaten asal
            'destination'   => 24, // ID kota/kabupaten tujuan
            'weight'        => 250, // berat barang dalam gram
            'courier'       => 'jne' // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();


        return response()->json($cost);
    }

    public function success(){
        return view('pages.success');
    }
}
