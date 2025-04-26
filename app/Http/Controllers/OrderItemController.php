<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // Show all items (optional)
    public function index()
    {
        $items = OrderItem::with('order', 'product')->get();
        return view('order_items.index', compact('items'));
    }

    // Edit item (optional)
    public function edit($id)
    {
        $item = OrderItem::findOrFail($id);
        return view('order_items.edit', compact('item'));
    }

    // Update item
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'other_charges' => 'nullable|numeric',
            'total_charges' => 'required|numeric',
        ]);

        $item = OrderItem::findOrFail($id);
        $item->update($request->all());

        return redirect()->back()->with('success', 'Item updated successfully.');
    }

    // Delete item
    public function destroy($id)
    {
        $item = OrderItem::findOrFail($id);
        $item->delete();

        return redirect()->back()->with('success', 'Item deleted successfully.');
    }
}
