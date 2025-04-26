@extends('layouts/contentNavbarLayout')

@section('title', 'Users - Analytics')

@section('page-script')
@vite('resources/assets/js/dashboards-analytics.js')
@endsection

@section('content')
<div class="col-xxl">
<div class="card mb-6">
<div class="d-flex justify-content-between align-items-center mt-4 mb-3 px-4">
    <h4 class="mb-0">Pattern List</h4>
    <a href="{{ route('Patterns.create') }}" class="btn btn-primary mt-4 mb-3 px-4">Add New Pattern</a>
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
    @foreach ($Patterns as $pattern)
    <tr>
        <td>{{ $pattern->id }}</td>
        <td>{{ $pattern->name }}</td>
        <td>{{ $pattern->code }}</td>
        <td>{{ $pattern->description }}</td>
        <td>{{ $pattern->status == 'Y' ? 'Active' : "In-Active" }}</td>
            <td>
             <a href="{{ route('Patterns.edit', $pattern->id) }}" class="btn btn-warning">Edit</a>
                
                <form action="{{ route('Patterns.destroy', $pattern->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this pattern?')">Delete</button>
                </form>
            </td>
    </tr>
    @endforeach
        </tbody>
</table>
</div>
</div>
@endsection