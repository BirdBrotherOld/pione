<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class CheckoutController extends Controller
{
    public function index(){
        $cartItems = Cart::where('user_id', Auth::id())->get();

        return view('pages.checkout', [
            'cartItems' => $cartItems
        ]);
    }

    public function checkout(Request $request){

        //TODO = User Auth
        $user = Auth::user();
        $user->update($request->except(['total_price', 'shipping_price']));
        
        // Proses checkout
        $code = 'Patriot-' . mt_rand(0000,9999) . '-Transaction';
        $carts = Cart::with(['product', 'event','user'])
                    ->where('user_id', Auth::user()->id)
                    ->get();
        
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'shipping_price' => $request->shipping_price,
            'total_price' => $request->total_price,
            'transaction_status' => 'PENDING',
            'code' => $code
        ]);

        foreach ($carts as $cart) {
            $trx = 'TRX-' . mt_rand(0000, 9999);
            // $product = Product::where('id', $cart->product->id);
            // $product->decrement('qty', $cart->qty);

            if ($cart->product_id == null) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'event_id' => $cart->event->id,
                    'qty' => $cart->qty,
                    'price' => $cart->event->price * $cart->qty,
                    'resi' => '',
                    'code' => $trx,
                ]);
            } elseif ($cart->event_id == null) {
                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $cart->product->id,
                    'qty' => $cart->qty,
                    'price' => $cart->product->price * $cart->qty,
                    'resi' => '',
                    'code' => $trx,
                ]);
            }
        }

        // Delete cart data
        Cart::with(['product', 'event_id', 'user'])
                ->where('user_id', Auth::user()->id)
                ->delete();

        return redirect()->route('success');
    }
}
