@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')

<div class="col-xxl">
<div class="card mb-6">
<h5 class="mt-5 ms-5 text-start">Create Users</h5>
    <div class="card-body">
    <form method="POST" action="{{ route('customer.store') }}">
        @csrf
      
        <div class="row mb-3">
        <div class="col-md-6">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" name="firstname" class="form-control" required>
        </div>
        </div>
        
        <div class="col-md-6">
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="lastname" class="form-control" required>
        </div>
        </div>
        </div>
      
        <div class="row mb-3">
        <div class="col-md-6">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        </div>

        <div class="col-md-6">
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        </div>
        </div>
       
        <div class="row mb-3">
        <div class="col-md-6">
        <div class="form-group">
            <label>Role</label>
            <select name="role" class="form-control" required>
                <option value="customer">Customer</option>
                <option value="warehouse">Warehouse</option>
            </select>
        </div>
        </div>
        </div>
      
        <div class="text-center">
        <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
    </div>
</div>
</div>
</div>


@endsection