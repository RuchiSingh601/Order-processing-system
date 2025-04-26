@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
<div class="col-xxl">
<div class="card mb-6">
<div class="d-flex justify-content-between align-items-center mt-4 mb-3 px-4">
    <h4 class="mb-0">Sizes List</h4>
    <a href="{{ route('Sizes.create') }}" class="btn btn-primary mt-4 mb-3 px-4">Add New Size</a>
</div>
@csrf
<br>
<table class="table mt-3">
<thead>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Code</th>
        <th>Description</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($Sizes as $size)
    <tr>
        <td>{{ $size->id }}</td>
        <td>{{ $size->name }}</td>
        <td>{{ $size->code }}</td>
        <td>{{ $size->description }}</td>
        <td>{{ $size->status == 'Y' ? 'Active' : "In-Active" }}</td>
            <td>
             <a href="{{ route('Sizes.edit', $size->id) }}" class="btn btn-warning">Edit</a>
                
                <form action="{{ route('Sizes.destroy', $size->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this size?')">Delete</button>
                </form>
            </td>
    </tr>
    @endforeach
        </tbody>
</table>
</div>
</div>
@endsection