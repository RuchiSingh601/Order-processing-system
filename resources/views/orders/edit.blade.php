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
                    <label>Delivery Date</label>
                    <input type="date" name="delivery_date" class="form-control"  min="{{ \Carbon\Carbon::parse($order->order_date)->addDay()->format('Y-m-d') }}" 
                    value="{{ old('delivery_date', \Carbon\Carbon::parse($order->delivery_date)->format('Y-m-d')) }}" required>
                </div>
            </div> 

            <div class="card-body px-4">
                <h5 class="mb-3">Order Items</h5>
                <div class="table-responsive" style="overflow-x: auto; white-space: nowrap;">
                    <table class="table table-bordered w-100" id="product_table" style="min-width: 1200px;">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 12%;">Product</th>
                                <th style="width: 15%;">Shade</th>
                                <th style="width: 15%;">Size</th>
                                <th style="width: 15%;">Pattern</th>
                                <th style="width: 8%;">Embroidery</th>
                                <th style="width: 10%;">Price</th>
                                <th style="width: 10%;">Qty</th>
                                <th style="width: 1%;">Other Charges</th>
                                <th style="width: 17%;">Total</th>
                                <th style="width: 5%;">
                                    <button type="button" onclick="addRow()" class="btn btn-success btn-sm">+</button>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(!empty($orderItems) && $orderItems->count())
                        @foreach($orderItems as $index => $item)
                                <tr>
                                    <td style="width: 12%;">
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
                                    <td style="width: 15%;">
                                        <select name="products[{{ $index }}][shade_id]" class="form-control shade-select">
                                            <option value="">Select Shade</option>
                                            @foreach($shades as $shade)
                                            <option value="{{ $shade->id }}" data-price="{{ $shade->base_price }}" {{ $shade->id == $item->shade_id ? 'selected' : '' }}>
                                                    {{ $shade->name }}
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 15%;">
                                        <select name="products[{{ $index }}][size_id]" class="form-control size-select">
                                            <option value="">Select Size</option>
                                            @foreach($sizes as $size)
                                                <option value="{{ $size->id }}" data-price="{{ $size->base_price }}" {{ $size->id == $item->size_id ? 'selected' : '' }}>{{ $size->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 15%;">
                                        <select name="products[{{ $index }}][pattern_id]" class="form-control pattern-select">
                                            <option value="">Select Pattern</option>
                                            @foreach($patterns as $pattern)
                                                <option value="{{ $pattern->id }}" data-price="{{ $pattern->base_price }}" {{ $pattern->id == $item->pattern_id ? 'selected' : '' }}>{{ $pattern->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 8%;"> 
                                        <select name="products[{{ $index }}][embroidery_id]" class="form-control embroidery-select">
                                            <option value="">Select Embroidery</option>
                                            @foreach($embroideries as $embroidery)
                                                <option value="{{ $embroidery->id }}" data-price="{{ $embroidery->base_price }}" {{ $embroidery->id == $item->embroidery_id ? 'selected' : '' }}>{{ $embroidery->embroidery_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 10%;">
                                        <input type="text" name="products[{{ $index }}][price]" class="form-control price" value="{{ $item->price }}" readonly>
                                    </td>
                                    <td style="width: 10%;">
                                        <input type="number" name="products[{{ $index }}][quantity]" class="form-control quantity" value="{{ $item->quantity }}">
                                    </td>
                                    <td style="width: 1%;">
                                        <input type="number" name="products[{{ $index }}][other_charges]" class="form-control other_charges" value="{{ $item->other_charges }}">
                                    </td>
                                    <td style="width: 17%;">
                                        <input type="text" name="products[{{ $index }}][total_charges]" class="form-control total" value="{{ $item->total_charges }}" readonly>
                                    </td>
                                    <td style="width: 5%;">
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


{{-- Script --}}
<script>
    let rowIndex = 1;
    let totalAmount = "";

    function addRow() {
        const table = document.querySelector('#product_table tbody');
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <select name="products[${rowIndex}][product_id]" class="form-control product-select" required>
                    <option value="">Select</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                    @endforeach
                </select>
            </td>
             <td>
            <select name="products[${rowIndex}][shade_id]" class="form-control shade-select">
                <option value="">Select Shade</option>
                @foreach($shades as $shade)
                    <option value="{{ $shade->id }}" data-price="{{ $shade->base_price }}">{{ $shade->name }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="products[${rowIndex}][size_id]" class="form-control size-select">
                <option value="">Select Size</option>
                @foreach($sizes as $size)
                    <option value="{{ $size->id }}" data-price="{{ $size->base_price }}">{{ $size->name }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="products[${rowIndex}][pattern_id]" class="form-control pattern-select">
                <option value="">Select Pattern</option>
                @foreach($patterns as $pattern)
                    <option value="{{ $pattern->id }}" data-price="{{ $pattern->base_price }}">{{ $pattern->name }}</option>
                @endforeach
            </select>
        </td>
        <td>
            <select name="products[${rowIndex}][embroidery_id]" class="form-control embroidery-select">
                <option value="">Select Embroidery</option>
                @foreach($embroideries as $embroidery)
                    <option value="{{ $embroidery->id }}" data-price="{{ $embroidery->base_price }}">{{ $embroidery->embroidery_name }}</option>
                @endforeach
            </select>
        </td>
            <td><input type="text" name="products[${rowIndex}][price]" class="form-control price" readonly></td>
            <td><input type="number" name="products[${rowIndex}][quantity]" class="form-control quantity" value="1"></td>
            <td><input type="number" name="products[${rowIndex}][other_charges]" class="form-control other_charges" value="0"></td>
            <td><input type="text" name="products[${rowIndex}][total_charges]" class="form-control total" readonly></td>
            <td><button type="button" onclick="removeRow(this)" class="btn btn-danger btn-sm">x</button></td>
        `;
        table.appendChild(row);
        rowIndex++;
    }

    function removeRow(btn) {
        btn.closest('tr').remove();
    }

    document.addEventListener('change', function(e) {
        const row = e.target.closest('tr');
        if (!row) return;

        // product
        const product = row.querySelector('.product-select');
        let price = product.options[product.selectedIndex]?.dataset?.price || 0;

        //shard
        const shade = row.querySelector('.shade-select');
        if(shade){
            const shade_base_price = shade.options[shade.selectedIndex]?.dataset?.price || 0;
            if(shade_base_price > 0) {
                price = parseFloat(price) + parseFloat(shade_base_price);
            }
        }

        
        //Size
        const size = row.querySelector('.size-select');
        if(size){
            const size_base_price = size.options[size.selectedIndex]?.dataset?.price || 0;
            if(size_base_price > 0) {
                price = parseFloat(price) + parseFloat(size_base_price);
            }
        }

        //Pattern
        const pattern = row.querySelector('.pattern-select');
        if(pattern){
            const pattern_base_price = pattern.options[pattern.selectedIndex]?.dataset?.price || 0;
            if(pattern_base_price > 0) {
                price = parseFloat(price) + parseFloat(pattern_base_price);
            }
        }

        //Embroidery
        const embroidery = row.querySelector('.embroidery-select');
        if(embroidery){
            const embroidery_base_price = embroidery.options[embroidery.selectedIndex]?.dataset?.price || 0;
            if(embroidery_base_price > 0) {
                price = parseFloat(price) + parseFloat(embroidery_base_price);
            }
        }


        const quantity = parseFloat(row.querySelector('.quantity').value) || 1;
        const other = parseFloat(row.querySelector('.other_charges').value) || 0;

        row.querySelector('.price').value = price;
        row.querySelector('.total').value = ((price * quantity) + other).toFixed(2);

        calculateTotalAmount();
    });

    function calculateTotalAmount() {
        let totalAmount = 0;
        const rows = document.querySelectorAll('#product_table tbody tr');
        rows.forEach(row => {
            const total = parseFloat(row.querySelector('.total').value) || 0;
            totalAmount += total;
        });
        document.getElementById('totalAmount').value = totalAmount.toFixed(2);
    }
</script>
@endsection
