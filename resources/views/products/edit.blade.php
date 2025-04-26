@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
<div class="col-xxl">
    <div class="card mb-4 p-4">
    <h4 class="mb-4">Edit Product</h4>

<form action="{{ route('products.update', $product->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="row mb-3">
            <div class="col-md-6">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $product->name ?? '') }}" required>
            </div>
            <div class="col-md-6">
                <label>Price</label>
                <input type="number" name="price" step="0.01" class="form-control" value="{{ old('price', $product->price ?? '') }}" required>
            </div>
        </div>

        <div class="row mb-3">
            @foreach (['warehouse' => $warehouses, 'pattern' => $patterns, 'shade' => $shades, 'size' => $sizes] as $field => $items)
            <div class="col-md-6 mb-3">
                <label>{{ ucfirst($field) }}</label>
                <select name="{{ $field }}_id" class="form-control" required>
                    <option value="">Select {{ ucfirst($field) }}</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ (old("{$field}_id", $product->{$field . '_id'} ?? '') == $item->id) ? 'selected' : '' }}>
                            {{ $item->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endforeach
        </div>

        <div class="col-md-6">
            <input type="checkbox" class="form-check-input" id="is_embroidery" name="is_embroidery" value="Yes">
            <label class="form-check-label" for="is_embroidery">Is Embroidery?</label>
        </div>
        <br/>
        <div class="row mb-3">
            @foreach (['embroidery' => $embroideries] as $field => $items)
            <div class="col-md-6 mb-3">
                <label>{{ ucfirst($field) }}</label>
                <select name="{{ $field }}_id" class="form-control" required>
                    <option value="">Select {{ ucfirst($field) }}</option>
                    @foreach($items as $item)
                        <option value="{{ $item->id }}" {{ (old("{$field}_id", $product->{$field . '_id'} ?? '') == $item->id) ? 'selected' : '' }}>
                            {{ $item->embroidery_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endforeach
       
            <div class="col-md-6">
                <label>Embroidery Charges</label>
                <input type="number" name="embroidery_charges" step="0.01" class="form-control" value="{{ old('embroidery_charges', $product->embroidery_charges ?? '') }}">
            </div>
        </div>
    
    <div class="d-flex justify-content-center px-4">
    <button type="submit" class="btn btn-primary">Update</button>
    </br>
</div>
</form>
</div>
</div>
@endsection