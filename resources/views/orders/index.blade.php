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
                @if(auth()->user()->role->name === 'admin')
                    <th>User</th>
                @endif
                <th width="20%">Order Number</th>
                <th width="20%">Order Date</th>
                <th width="10%">Total Amount</th> 
                <th width="10%">Payment Method</th>
                <th width="10%">Status</th>
                <th width="20%">Delivery Date</th>
                <th width="10%">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                @if(auth()->user()->role->name === 'admin')
                    <td>{{ $order->user_id }}</td>
                @endif
                <td width="20%">{{ $order->order_number }}</td>
                <td width="20%">{{ $order->order_date }}</td>
                <td width="10%">{{ $order->total_amount }}</td>
                <td width="10%">{{ $order->paymentMethod->name ?? 'N/A' }}</td>
                <td width="10%">{{ $order->status == 1 ? 'Pending' : 'Complete' }}</td>
                <td width="20%">{{ $order->delivery_date }}</td>
                <td width="10%">
                    <a href="{{ route('order.edit', $order->id) }}" title="Edit"><i class="bx bx-edit-alt text-warning" style="font-size: 1.2rem;"></i></a>
                   
                    <form action="{{ route('order.destroy', $order->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this order?')" style="background: none; border: none; padding: 0;" title="Delete">
                          <i class="bx bx-trash text-danger" style="font-size: 1.2rem;"></i>
                        </button>
                    </form>
                </td>
            </tr>
    @endforeach
    </tbody>
</table>
</div>
</div>
@endsection