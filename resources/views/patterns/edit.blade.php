@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')

<div class="col-xxl">
    <div class="card mb-6">
        <h4 class="mt-5 ms-5 text-start">Edit Pattern</h4>

        <form action="{{ route('patterns.update', $pattern->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-3 ms-1 me-1">
                <div class="col-md-5">
                <label class="form-label ms-5">Warehouse Id</label>
                    <select name="warehouse_id" id="warehouse_id" class="form-control ms-5" required>
                        <option value="">Select Warehouse</option>
                        @foreach($warehouses as $warehouse)
                            <option value="{{ $warehouse->id }}" {{ $pattern->warehouse_id == $warehouse->id ? 'selected' : '' }}>{{ $warehouse->name }}</option>
                        @endforeach
                    </select>
            </div>
                 <div class="col-md-5">
                    <label class="form-label ms-5">pattern Name:</label>
                    <input type="text" name="name" class="form-control ms-5" value="{{ old('name', $pattern->name) }}" required>
                </div>
            </div>
            <div class="row mb-3 ms-1 me-1">
                <div class="col-md-5">
                    <label class="form-label ms-5">Code(optional):</label>
                    <input type="text" name="code" class="form-control ms-5" value="{{ old('code', $pattern->code) }}">
                </div>

                <div class="col-md-5">
                    <label class="form-label ms-5">Description:</label>
                    <input type="description" class="form-control ms-5" value="{{ old('Description', $pattern->description) }}">
                </div>
            </div>
            <div class="row mb-3 ms-1 me-1">
                    <div class="col-md-5">
                        <label class="ms-5">Base Price</label>
                        <input type="number" step="0.01" name="base_price" class="form-control ms-5" value="{{ old('base_price', $pattern->base_price ?? '') }}" required>
                    </div>
            </div>
            <div class="row mb-3 ms-1 me-1">
                <div class="col-md-5">
                    <!-- <label class="form-label ms-5">Status:</label>
                    <select name="status" class="form-control ms-5" required>
                        <option value="Active" {{ $pattern->status == 'Active' ? 'selected' : '' }}>Active</option>
                        <option value="Inactive" {{ $pattern->status == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                    </select> -->

                    <input type="checkbox" class="form-check-input mt-5 ms-5" id="status" name="status" value="Active" {{ $pattern->status == 'Y' ? 'checked' : '' }}>
                    <label class="form-check-label mt-5" for="status">Is Active</label>
                </div>
            </div>

            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-primary">Update pattern</button>
            </div>
    </br>
     </form>

    </div>
</div>
@endsection
