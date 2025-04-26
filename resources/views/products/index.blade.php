@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
<div class="col-xxl">
<div class="card mb-6">
<div class="d-flex justify-content-between align-items-center mt-4 mb-3 px-4">
<h4 class="mb-0">Product List</h4>
    <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add Product</a>
</div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Warehouse</th>
                <th>Pattern</th>
                <th>Shade</th>
                <th>Size</th>
                <th>Embroidery</th>
                <th>Price</th>
                <th>Embroidery Charges</th>
                <th>Is Embroidery</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->warehouse->name ?? 'N/A' }}</td>
                <td>{{ $product->pattern->name ?? 'N/A' }}</td>
                <td>{{ $product->shade->name ?? 'N/A' }}</td>
                <td>{{ $product->size->name ?? 'N/A' }}</td>
                <td>{{ $product->embroidery->name ?? 'N/A' }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->embroidery_charges }}</td>
                <td>{{ $product->is_embroidery ? 'Yes' : 'No' }}</td>
                <td>
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-info">Edit</a>
                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>
</div>
@endsection