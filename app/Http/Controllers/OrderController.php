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
      
        return redirect()->route('order.index')->with('success', 'Order created successfully.');
    }
    public function edit($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
        $warehouses = Warehouse::all();
        $products = Product::all();
        $paymentMethods = PaymentMethod::all();
        $orderItems = \App\Models\OrderItem::where('order_id', $order->id)->get();


        return view('orders.edit', compact('order', 'warehouses', 'products',  'orderItems' , 'paymentMethods'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'order_number' => 'required|string|max:255',
            'order_date' => 'required|date',
            'warehouse_id' => 'required|integer|exists:warehouses,id',
            'products' => 'required|array',
            'products.*.product_id' => 'required|integer|exists:products,id',
            'products.*.price' => 'required|numeric',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.other_charges' => 'nullable|numeric',
            'products.*.total_charges' => 'required|numeric',
            'payment_id' => 'required|integer|exists:paymentmethods,id',
            'status' => 'required|string|in:pending,completed',
            'total_amount' => 'required|numeric',
        ]);
    
        // Find the order by ID
        $order = Order::findOrFail($id);
    
        // Update order header fields
        $order->order_date = $validated['order_date'];
        $order->warehouse_id = $validated['warehouse_id'];
        $order->payment_id = $validated['payment_id'];
        $order->status = $validated['status'] == 'pending' ? 1 : 0;
        $order->total_amount = $validated['total_amount'];
        $order->save();
    
        // Get the currently authenticated user
        $user = auth()->user();
    
        // Delete existing order items (assuming full replacement)
        $order->orderItems()->delete();
    
        // Recreate order items
        foreach ($validated['products'] as $product) {
            OrderItem::create([
                'warehouse_id' => $request->warehouse_id,
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'user_id' => $user->id,
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'other_charges' => $product['other_charges'] ?? 0,
                'total_charges' => $product['total_charges'],
                'delivery_date' => now(),
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
      
