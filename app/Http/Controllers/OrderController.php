<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Shade;
use App\Models\Pattern;
use App\Models\Size;
use App\Models\Paymentmethod;
use App\Models\Embroidery;
use App\Models\User;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index() {
        $user = Auth::user(); 
        $role = $user->role->name ?? null; 
        $orders = [];
        if ($role === 'admin') {
            $orders = Order::all(); 
        } elseif ($role == 'customer') {
            $orders = Order::where('user_id', $user->id)->get();
        } 
        $items = $orders;
        return view('orders.index', compact('orders'));
     }

     public function create()
     {
        $customers = User::all(); 
        $paymentMethods = PaymentMethod::where('status', 1)->get();
        $shades = Shade::all();
        $patterns = Pattern::all();
        $sizes = Size::all();
        $embroideries = Embroidery::all();
        $products = Product::all(); 
        $warehouses = Warehouse::all(); 
        return view('orders.create', compact( 'customers', 'shades', 'patterns', 'sizes', 'embroideries', 'paymentMethods', 'products', 'warehouses'));
     }

     public function store(Request $request)
     {
     
        try {

            Log::info('1');
        $request->validate([
            'order_number' => 'required|string',
            'order_date' => 'required|date',
            'warehouse_id' => 'required|numeric',
            'payment_id' => 'required|nullable',
            'status' => 'required|in:pending,completed', 
            'total_amount' => 'required|numeric',
        ]);

        $user = Auth::user(); 
           
        $request->merge([
            'status' => 1,
            'user_id' =>$user->id
        ]);

        $order = Order::create($request->all());

        Log::info('2');

        foreach ($request->products as $product) {
            OrderItem::create([
                'warehouse_id' => $request->warehouse_id,
                'order_id' => $order->id, // Foreign key
                'product_id' => $product['product_id'],
                'user_id' => $user->id,
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'other_charges' => $product['other_charges'] ?? 0,
                'total_charges' => $product['total_charges'],
                'delivery_date' => now(),
            ]);
        }
        Log::info('3');
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return redirect()->back()->with('error', 'Error creating order: ' . $e->getMessage());
        }
        Log::info('5 : Complated');
        // $order = new Order();
        //         $order->order_number = $request->order_number;
        //         $order->order_date = $request->order_date;
        //         $order->warehouse_id = $request->warehouse_id;
        //         $order->user_id = $request->user_id;
        //         $order->payment_method = $request->payment_method;
        //         $order->status = $request->status ?? 'pending';
        //         $order->total_amount = 0; 
        //        // $order->save();

        //         $totalAmount = 0;

        // foreach ($request->products as $product) {
        //          $order->items()->create([
        //         'product_id' => $product['product_id'],
        //         'price' => $product['price'],
        //         'quantity' => $product['quantity'],
        //         'other_charges' => $product['other_charges'],
        //         'total_charges' => $product['total_charges'],
        //     ]);
    
        //     $totalAmount += $product['total_charges'];
        // }
    
        // $order->total_amount = $totalAmount;
        // $order->save();
    
        return redirect()->route('order.index')->with('success', 'Order created successfully.');
    }
    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $warehouses = Warehouse::all();
        $products = Product::all();
       // $paymentMethods = PaymentMethod::all();
        $orderItems = \App\Models\OrderItem::where('order_id', $order->id)->get();


        return view('orders.edit', compact('order', 'warehouses', 'products',  'orderItems'));
    }

    public function update(Request $request, $id)
    {
    // Validate the incoming request data
    $validated = $request->validate([
        'order_number' => 'required|string|max:255',
        'order_date' => 'required|date',
        'warehouse_id' => 'required|integer|exists:warehouses,id',
        'products' => 'required|array',
        // 'products.*.product_id' => 'required|integer|exists:products,id',
        // 'products.*.price' => 'required|numeric',
        // 'products.*.quantity' => 'required|integer|min:1',
        // 'products.*.other_charges' => 'nullable|numeric',
        // 'products.*.total_charges' => 'required|numeric',
        //'paymentMethods' => 'required',
         'payment_id' => 'required|integer|exists:payment_methods,id',
        'status' => 'required|string|in:pending,completed',
        'total_amount' => 'required|numeric',
    ]);

    // Find the order by ID
    $order = Order::findOrFail($id);

    // Update order header fields
    $order->order_number = $validated['order_number'];
    $order->order_date = $validated['order_date'];
    $order->warehouse_id = $validated['warehouse_id'];
    $order->payment_id = $validated['payment_id'];
    $order->status = $validated['status'];
    $order->total_amount = $validated['total_amount'];
    $order->save();

    // Delete existing order items (assuming full replacement)
    $order->orderItems()->delete();

    // Recreate order items
    foreach ($validated['products'] as $product) {
        $order->orderItems()->create([
            'product_id' => $product['product_id'],
            'price' => $product['price'],
            'quantity' => $product['quantity'],
            'other_charges' => $product['other_charges'] ?? 0,
            'total_charges' => $product['total_charges'],
        ]);
    }

    return redirect()->route('order.index')->with('success', 'Order updated successfully.');
}


public function destroy($id)
{
    $order = Order::findOrFail($id);
   // $order->orderItems()->delete(); // delete items first
    $order->delete(); // then delete order

    return redirect()->route('order.index')->with('success', 'Order deleted successfully.');
}
}
      
