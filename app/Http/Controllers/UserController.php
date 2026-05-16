<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Register;
use App\Models\PatientRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // ✅ List all users
    public function index()
    {
        $users = User::with('register')->latest()->get();
        $employees = Register::all();
        $appoinments = PatientRegistration::all(); // Fetching appointments for the view
        return view('admins.admin.users.index', compact('users', 'employees', 'appoinments'));
    }

    // ✅ Show create form
    public function create()
    {
        $registers = Register::all();
        return view('admins.admin.users.create', compact('registers'));
    }

    // ✅ Store user
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,doctor,patient',
            'register_id' => 'nullable|exists:registers,id',
            'address_id' => 'nullable|exists:registers,id',
            'phone_id' => 'nullable|exists:registers,id',
            'signature_id' => 'nullable|exists:registers,id',
            'appoinment_id' => 'nullable|exists:patient_registrations,id',
        ]);

        User::create([
            'register_id' => $request->register_id,
            'address_id' => $request->address_id,
            'phone_id' => $request->phone_id,
            'signature_id' => $request->signature_id,
            'appoinment_id' => $request->appoinment_id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    // ✅ Edit form
    public function edit(User $user)
    {
        $registers = Register::all();
        return view('users.edit', compact('user', 'registers'));
    }

    // ✅ Update
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,doctor,patient',
            'register_id' => 'nullable|exists:registers,id',
            'address_id' => 'nullable|exists:registers,id',
            'phone_id' => 'nullable|exists:registers,id',
            'signature_id' => 'nullable|exists:registers,id',
            'appoinment_id' => 'nullable|exists:patient_registrations,id',
        ]);

        $user->update([
            'register_id' => $request->register_id,
            'address_id' => $request->address_id,
            'phone_id' => $request->phone_id,
            'signature_id' => $request->signature_id,
            'appoinment_id' => $request->appoinment_id,
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User updated');
    }

    // ✅ Delete
    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted');
    }
}
