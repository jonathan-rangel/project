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
        //
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
        $smartphone = Smartphone::where('id', $request->get('smartphone_id'))->first();

        $productFound = Cart::where('smartphone_id', $request->get('smartphone_id'))->pluck('id');

        if($productFound->isEmpty()) {
            $cart = Cart::create([
                'smartphone_id' => $smartphone->id,
                'quantity' => 1,
                'total_price' => $smartphone->sale_price,
                'user_id' => auth()->user()->id,
            ]);
        } else {
            $cart = Cart::where('smartphone_id', $request->get('smartphone_id'))->increment('quantity');
        }

        $userItems = Cart::where('user_id', auth()->user()->id)->sum('quantity');

        if($cart) {
            return ['message' => 'Added to cart',
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
}
