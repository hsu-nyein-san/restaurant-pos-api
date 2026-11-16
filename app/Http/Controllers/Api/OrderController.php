<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders=Order::with('items.product')->latest()->get();

        return OrderResource::collection($orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $validated=$request->validated();

        $order=DB::transaction(function() use ($validated){
            $subtotal=0;

            foreach($validated['items'] as $item)
                {
                    $product=\App\Models\Product::findOrFail($item['product_id']);

                    $subtotal +=$product->price * $item['quantity'];

                }

            $discount=$validated['discount'] ?? 0;
            $tax=$validated['tax'] ?? 0;
            $total=$subtotal - $discount + $tax;

            $order=Order::create(
                [
                    'order_number'=>'ORD' . now()->format('YmdHis'),
                    'restaurant_table_id'=>$validated['restaurant_table_id'] ?? null,
                    'status'=>'pending',
                    'subtotal'=>$subtotal,
                    'discount'=>$discount,
                    'tax'=>$tax,
                    'total'=>$total,
                ]
            );

            foreach ($validated['items'] as $items)
                {
                    $product=\App\Models\Product::findOrFail($items['product_id']);
                    $quantity=$items['quantity'];
                    $unitPrice=$product->price;
                }

            $order->items()->create([
                'product_id'=>$product->id,
                'quantity'=>$quantity,
                'unit_price'=>$unitPrice,
                'subtotal'=>$quantity*$unitPrice
            ]);

            return $order;

        });


        return response()->json([
            'message'=>'Order created successfully',
            'data'=>new OrderResource($order)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return new OrderResource($order);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        $validated=$request->validated();

        $order->update($validated);

        return response()->json([
            'message'=>'Order updated successfully',
            'data'=>new OrderResource($order->load('items.product'))
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return response()->json([
            'message'=>'Order delete successfully'
        ]);
    }
}
