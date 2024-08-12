<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Cart;

class CartController extends Controller
{
    public function index(){
        $cartItems = Cart::instance('cart')->content();
        return view('cart', compact('cartItems'));
    }

    public function add(Request $request)
    {
        $product = Product::find($request->id);

        if (!$product) {
            return redirect()->route('cart.index')->with('error', 'Product not found.');
        }

        $price = $product->sale_price ? $product->sale_price : $product->regular_price;

        Cart::instance('cart')->add($product->id, $product->name, $request->quantity, $price)->associate('App\Models\Product');

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }


    public function update(Request $request) {
        Cart::instance('cart')->update($request->rowId, $request->quantity);

        $subtotal = Cart::instance('cart')->subtotal();
        $tax = Cart::instance('cart')->tax();
        $total = Cart::instance('cart')->total();
        $itemSubtotal = Cart::get($request->rowId)->subtotal;

        return response()->json([
            'success' => true,
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total,
            'itemSubtotal' => $itemSubtotal,
        ]);
    }

    public function remove(Request $request){
        $rowId= $request->rowId;
        Cart::instance('cart')->remove($rowId);
        return redirect()->route('cart.index')->with('success', 'Product removed from cart successfully!');
    }

    public function clear(){
        Cart::instance('cart')->destroy();
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
}
