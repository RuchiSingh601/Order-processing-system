<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('customer.index', compact('users'));
    }

    public function create() {
        return view('customer.create');
    }

    public function store(Request $request) {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
            // 'role' => 'required'
        ]);
    
        User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => Hash::make($request->password)
            // 'role' => $request->role
        ]);
    
        return redirect()->route('customer.create')->with('success', 'customer created successfully.');
    }  
}
