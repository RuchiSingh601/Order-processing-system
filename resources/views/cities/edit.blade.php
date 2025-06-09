@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')

<div class="col-xxl">
    <div class="card mb-6">
        <h4 class="mt-5 ms-5 text-start">Edit City</h4>
        <div class="card-body">
            <form action="{{ route('cities.update', $city->id) }}" method="POST">
                @csrf
                @method('PUT')

                  <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>City Name</label>
                            <input type="city_name" name="city_name" class="form-control" value="{{ old('city_name', $city->city_name) }}" required>
                            @error('city_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                     <div class="col-md-4">
                        <div class="form-group">
                            <label>Delivery Charge</label>
                            <input type="delivery_charge" name="delivery_charge" class="form-control" value="{{ old('delivery_charge', $city->delivery_charge) }}" required>
                            @error('delivery_charge')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                   
                    <div class="col-md-4">
                        <input type="checkbox" class="form-check-input mt-5 ms-5" id="status" name="status" value="Active" {{ $city->status == 'Y' ? 'checked' : '' }} >
                        <label class="form-check-label mt-5" for="status">Is Active</label>
                    </div>
                </div>
            
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Update City</button>
                </div>
            </br>
            </form>
        </div>
    </div>
</div>
@endsection