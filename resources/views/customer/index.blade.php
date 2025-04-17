@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')

<div class="col-xxl">
<div class="card mb-6">
    <h5 class="mt-5 ms-6 text-start">All Users</h5>
    <div class="card-body">
    <div class="d-flex justify-content-start mb-3">
    <a href="{{ route('customer.create') }}" class="btn btn-success">Add New User</a>
    </div>
    @csrf
    <table class="table table-bordered">
    <div class="row mb-3">
    <div class="col-md-6">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ ucfirst($user->role) }}</td>
        </tr>
        @endforeach
</div>
</div>
    </table>
</div>
</div>
</div>
</div>
@endsection