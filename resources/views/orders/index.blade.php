@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
<div class="col-xxl">
    <div class="card mb-6">
        <div class="d-flex justify-content-between align-items-center mt-4 mb-3 px-4">
            <h4 class="mb-0">Order List</h4>
            <a href="{{ route('order.create') }}" class="btn btn-primary mb-3">Add Order</a>
        </div>
@csrf

<table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Warehouse</th>
                <th>Total Amount</th>
                <th>Order Number</th>
                <th>Order Date</th>
                <th>User</th>
                <th>Payment Method</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->warehouse_id }}</td>
                <td>{{ $order->total_amount }}</td>
                <td>{{ $order->order_number }}</td>
                <td>{{ $order->order_date }}</td>
                <td>{{ $order->user_id }}</td>
                <td>{{ $order->payment_method }}</td>
                <td>{{ $order->status }}</td>
                <td>
                    <a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>
@endsection