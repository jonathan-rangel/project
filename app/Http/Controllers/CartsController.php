<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smartphone;
use App\Models\Cart;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userItems = Cart::where('user_id', auth()->user()->id)->sum('quantity');

        if(!$request->get('smartphone_id')) {
            return [
                'message' => 'Cart items returned',
                'items' => $userItems
            ];
        }

        $smartphone = Smartphone::where('id', $request->get('smartphone_id'))->first();

        $productFound = Cart::where('smartphone_id', $request->get('smartphone_id'))->pluck('id');

        if($productFound->isEmpty()) {
            $cart = Cart::create([
                'smartphone_id' => $smartphone->id,
                'quantity' => 1,
                'total_price' => $smartphone->sale_price,
                'user_id' => auth()->user()->id,
            ]);
            $message = 'Added to cart';
        }

        $userItems = Cart::where('user_id', auth()->user()->id)->sum('quantity');

        if($cart) {
            return [
                'message' => $message,
                'items' => $userItems
            ];
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getCartItems() {
        $cartItems = Cart::with('smartphone')->where('user_id', auth()->user()->id)->get();

        $finalData = [];

        $amount = 0;


        if(isset($cartItems))
        {
            foreach($cartItems as $cartItem)
            {
                if($cartItem->smartphone)
                {
                    foreach($cartItem->smartphone as $cartProduct)
                    {
                        if($cartProduct->id == $cartItem->smartphone_id)
                        {
                            $finalData[$cartItem->smartphone_id]['id'] = $cartProduct->id;
                            $finalData[$cartItem->smartphone_id]['name'] = $cartProduct->name;
                            $finalData[$cartItem->smartphone_id]['image_name'] = $cartProduct->image_name;
                            $finalData[$cartItem->smartphone_id]['quantity'] = $cartItem->quantity;
                            $finalData[$cartItem->smartphone_id]['total_price'] = $cartItem->total_price * $cartItem->quantity;
                            $amount += $cartItem->total_price * $cartItem->quantity;
                            $finalData['totalAmount'] = $amount;
                        }
                    }
                }
            }
        }
        return response()->json($finalData);
    }
}
