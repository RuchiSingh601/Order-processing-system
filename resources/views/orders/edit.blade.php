@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')

<div class="col-xxl">
    <div class="card mb-6">
        <h4 class="mt-5 ms-5 text-start">Edit Item</h4>

        <form method="POST" action="{{ route('order.update', $order->id) }}">
            @csrf
            @method('PUT')

            <div class="row mb-3 px-4">
                <div class="col-md-6">
                    <label>Order Number</label>
                    <input type="text" name="order_number" value="{{ $order->order_number }}" class="form-control" readonly>
                </div>
                <div class="col-md-6">
                    <label>Order Date</label>
                    <input type="date" name="order_date" class="form-control" value="{{ \Carbon\Carbon::parse($order->order_date)->format('Y-m-d') }}" required>

                </div>
            </div>

            <div class="row mb-3 px-4">
                <div class="col-md-6">
                    <label>Warehouse</label>
                    <select name="warehouse_id" class="form-control" required>
                        <option value="">Select Warehouse</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $warehouse->id == $order->warehouse_id ? 'selected' : '' }}>
                                {{ $warehouse->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-body px-4">
                <h5 class="mb-3">Order Items</h5>
                <div class="table-responsive">
                    <table class="table table-bordered" id="product_table">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Other Charges</th>
                                <th>Total</th>
                                <th>
                                    <button type="button" onclick="addRow()" class="btn btn-success btn-sm">+</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($orderItems) && $orderItems->count())
                        @foreach($orderItems as $index => $item)
                                <tr>
                                    <td>
                                        <select name="products[{{ $index }}][product_id]" class="form-control product-select" required>
                                            <option value="">Select</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" 
                                                    data-price="{{ $product->price }}"
                                                    {{ $product->id == $item->product_id ? 'selected' : '' }}>
                                                    {{ $product->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" name="products[{{ $index }}][price]" class="form-control price" value="{{ $item->price }}" readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="products[{{ $index }}][quantity]" class="form-control quantity" value="{{ $item->quantity }}">
                                    </td>
                                    <td>
                                        <input type="number" name="products[{{ $index }}][other_charges]" class="form-control other_charges" value="{{ $item->other_charges }}">
                                    </td>
                                    <td>
                                        <input type="text" name="products[{{ $index }}][total_charges]" class="form-control total" value="{{ $item->total_charges }}" readonly>
                                    </td>
                                    <td>
                                        <button type="button" onclick="removeRow(this)" class="btn btn-danger btn-sm">x</button>
                                    </td>
                                </tr>
                            @endforeach
                            @else
    <tr>
        <td colspan="6" class="text-center">No products added yet.</td>
    </tr>
@endif
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Payment & Delivery --}}
            <div class="card-body px-4 pt-0">
                <h5 class="mb-3">Payment & Delivery</h5>
                <div class="row">
                    <div class="col-md-4">
                        <label>Payment Method</label>
                        <select name="payment_id" class="form-control" required>
                            <option value="">Select Payment Method</option>
                            @foreach($paymentMethods as $paymentMethod)
                                <option value="{{ $paymentMethod->id }}" {{ $paymentMethod->id == $order->payment_id ? 'selected' : '' }}>
                                    {{ $paymentMethod->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Total Amount</label>
                        <input type="text" name="total_amount" id="totalAmount" class="form-control" value="{{ $order->total_amount }}">
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        <button type="submit" class="btn btn-primary">Update Order</button>
                    </div>
                </div>
            </div>

        </form>
    </div>   
</div>
@endsection
