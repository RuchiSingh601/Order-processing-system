@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
    @vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
<div class="col-xxl">
<div class="card mb-6">
        
            <h5 class="mt-4 ms-4">Add New Order</h5>
            <form method="POST" action="{{ route('order.store') }}">
                @csrf

                <div class="row mb-3 px-4">
                    <div class="col-md-6">
                        <label>Order Number</label>
                        <input type="text" name="order_number" value="ORD{{ time() }}" class="form-control" readonly>
                    </div>
                    <div class="col-md-6">
                        <label>Order Date</label>
                        <input type="date" name="order_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="row mb-3 px-4">
                    <div class="col-md-6">
                        <label>Warehouse</label>
                        <select name="warehouse_id" class="form-control" required>
                            <option value="">Select Warehouse</option>
                            @foreach($warehouses as $warehouse)
                                <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <div class="col-md-6">
                        <label>Customer</label>
                             @if(Auth::user()->role === 'admin' || Auth::user()->role === 'staff')
                                 <select name="user_id" class="form-control" required>
                                     <option value="">Select Customer</option>
                                         @foreach($customers as $customer)
                                             <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                         @endforeach
                                    </select>
                                @else
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            @endif
                    </div> -->
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
                                <tr>
                                    <td>
                                        <select name="products[0][product_id]" class="form-control product-select" required>
                                            <option value="">Select</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->price }}">{{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><input type="text" name="products[0][price]" class="form-control price" readonly></td>
                                    <td><input type="number" name="products[0][quantity]" class="form-control quantity" value="1"></td>
                                    <td><input type="number" name="products[0][other_charges]" class="form-control other_charges" value="0"></td>
                                    <td><input type="text" name="products[0][total_charges]" class="form-control total" readonly></td>
                                    <td><button type="button" onclick="removeRow(this)" class="btn btn-danger btn-sm">x</button></td>
                                </tr>
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
                                    <option value="{{ $paymentMethod->id }}">{{ $paymentMethod->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="pending" selected>Pending</option>
                                <option value="completed">Completed</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label>Total Amount</label>
                                <input type="text" name="total_amount" id="totalAmount" class="form-control"></input>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="d-flex justify-content-center px-4">
                    <button type="submit" class="btn btn-primary">Submit Order</button>
                </div>
            </br>
            </form>
        </div>
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

        const product = row.querySelector('.product-select');
        const price = product.options[product.selectedIndex]?.dataset?.price || 0;
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
