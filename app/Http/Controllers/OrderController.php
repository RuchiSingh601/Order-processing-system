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
            $orders = Order::with('paymentMethod')->get(); 
        } elseif ($role == 'customer') {
            $orders = Order::with('paymentMethod')->where('user_id', $user->id)->get();
        }
        $items = $orders;
        $paymentMethods = PaymentMethod::where('status', 1)->get();
        
        return view('orders.index', compact('orders', 'paymentMethods'));
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
        //$warehouses = Warehouse::all(); 
        return view('orders.create', compact( 'customers', 'shades', 'patterns', 'sizes', 'embroideries', 'paymentMethods', 'products'));
     }

     public function store(Request $request)
     {
        $products = $request->input('products');
        $totalPrice = 0;

        try {

            Log::info('1');
            $request->validate([
                'order_number' => 'required|string',
                'order_date' => 'required|date',
                'delivery_date' => 'required|date',
                'payment_id' => 'required|nullable',
                'status' => 'required|in:pending,completed', 
                'total_amount' => 'required|numeric',
            ]);

            $user = Auth::user(); 

            $warehouse_id = null;
            if($user->role->name =='customer'){
                $warehouse_id = session('selected_warehouse_id');
            }
            
            $request->merge([
                'status' => 1,
                'user_id' =>$user->id,
                'warehouse_id' => $warehouse_id
            ]);

            if($user->role->name =='customer'){
                $request->merge([
                    'warehouse_id' => $warehouse_id
                ]);
            }

            $order = Order::create($request->all());

            Log::info('2');

            foreach ($request->products as $product) {
                $orderItemData = [
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'user_id' => $user->id,
                    'price' => $product['price'],
                    'quantity' => $product['quantity'],
                    'other_charges' => $product['other_charges'] ?? 0,
                    'total_charges' => $product['total_charges'],
                    'shade_id' => $product['shade_id'] ?? null,
                    'size_id' => $product['size_id'] ?? null,
                    'pattern_id' => $product['pattern_id'] ?? null,
                    'embroidery_id' => $product['embroidery_id'] ?? null,
                ];
            
                if ($user->role->name == 'customer') {
                    $orderItemData['warehouse_id'] = $warehouse_id;
                }
            
                OrderItem::create($orderItemData);
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
        //$warehouses = Warehouse::all();
        $products = Product::all();
        $shades = Shade::all();
        $sizes = Size::all();
        $patterns = Pattern::all();
        $embroideries = Embroidery::all();
        $paymentMethods = PaymentMethod::all();
        $orderItems = \App\Models\OrderItem::where('order_id', $order->id)->get();


        return view('orders.edit', compact('order', 'products',  'orderItems' , 'paymentMethods', 'shades', 'sizes', 'patterns', 'embroideries'));  
    }

    public function update(Request $request, $id)
    {
        Log::info('2 : Complated');
        // Validate the incoming request data
        $validated = $request->validate([
            'order_number' => 'required|string|max:255',
            'order_date' => 'required|date',
            'delivery_date' => 'required|date',
            'payment_id' => 'required|integer|exists:paymentmethods,id',
            'status' => 'required|string|in:pending,completed',
            'total_amount' => 'required|numeric',
        ]);

        $user = Auth::user();
        $request->merge([
            'status' => 1,
            'user_id' =>$user->id,
            'warehouse_id' => session('selected_warehouse_id'),
        ]);
        Log::info('3 : Complated');
    
        // Find the order by ID
        $order = Order::findOrFail($id);
    
        // Update order header fields
        $order->order_number = $validated['order_number'];
        $order->order_date = $validated['order_date'];
        $order->delivery_date = $validated['delivery_date'];
        $order->warehouse_id = session('selected_warehouse_id');
        $order->payment_id = $validated['payment_id'];
        $order->status = $validated['status'] == 'pending' ? 1 : 0;
        $order->total_amount = $validated['total_amount'];
        $order->save();
        Log::info('4 : Complated');
        // Get the currently authenticated user
        $user = auth()->user();
    
        // Delete existing order items (assuming full replacement)
        $order->orderItems()->delete();

        $user = Auth::user(); 

        $warehouse_id = null;
        if($user->role->name =='customer'){
            $warehouse_id = session('selected_warehouse_id');
        }
        
        $request->merge([
            'user_id' =>$user->id,
            'warehouse_id' => $warehouse_id
        ]);

        if($user->role->name =='customer'){
            $request->merge([
                'warehouse_id' => $warehouse_id
            ]);
        }
    
        // Recreate order items
        foreach ($request->products as $product) {

            Log::info($product);

            OrderItem::create([
                'warehouse_id' => session('selected_warehouse_id'),
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'user_id' => $user->id,
                'price' => $product['price'],
                'quantity' => $product['quantity'],
                'other_charges' => $product['other_charges'] ?? 0,
                'total_charges' => $product['total_charges'],
                'shade_id' => $product['shade_id'] ?? null,
                'size_id' => $product['size_id'] ?? null,
                'pattern_id' => $product['pattern_id'] ?? null,
                'embroidery_id' => $product['embroidery_id'] ?? null,
                //'delivery_date' => now(),
            ]);
        }
        Log::info('5 : Complated');
        return redirect()->route('order.index')->with('success', 'Order updated successfully.');
    }

    public function destroy($id)
    {
        $order = Order::with('orderItems')->findOrFail($id);
       // $order = Order::findOrFail($id);
        $order->orderItems()->delete(); // delete items first
        $order->delete(); // then delete order

    return redirect()->route('order.index')->with('success', 'Order deleted successfully.');
}
}
      
