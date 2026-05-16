<?php

namespace App\Http\Controllers;

use App\Models\Register;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    // ✅ Show all records (LIST)
    public function index()
    {
        $registers = Register::latest()->get();
        return view('admins.admin.register', compact('registers'));
    }

    // ✅ Show create form
    // public function create()
    // {
    //     return view('register.create');
    // }

    // ✅ INSERT data
    public function store(Request $request)
    {
        $data = $request->validate([
            'emp_id' => 'required|unique:registers',
            'name' => 'required|unique:registers',
            'emp_fname' => 'nullable',
            'cnic' => 'nullable',
            'phone' => 'nullable',
            'date_of_birth' => 'nullable',
            'email' => 'required|email|unique:registers',
            'address' => 'nullable',
            'signature' => 'nullable',
            'active' => 'nullable',
        ]);

        if ($request->hasFile('signature')) {
            $image = $request->file('signature');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('banners', $imageName, 'public');
            $data['signature'] = $path;
        }

        Register::create($data);

        return redirect()->route('register.index')
                         ->with('success', 'Employee Added Successfully');
    }

    // ✅ Show edit form
    public function edit(Register $register)
    {
        $registers = Register::latest()->get();
        return view('admins.admin.register', compact('registers', 'register'));
    }



    // ✅ UPDATE data
    public function update(Request $request, Register $register)
    {
        $data = $request->validate([
            'emp_id' => 'required|unique:registers,emp_id,' . $register->id,
            'name' => 'required|unique:registers,name,' . $register->id,
            'cnic' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:registers,email,' . $register->id,
            'address' => 'nullable',
            'signature' => 'nullable',
        ]);

        if ($request->hasFile('signature')) {
            $image = $request->file('signature');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $path = $image->storeAs('banners', $imageName, 'public');
            $data['signature'] = $path;
        }

        $register->update($data);

        return redirect()->route('register.index')
                         ->with('success', 'Employee Updated Successfully');
    }

    // ✅ DELETE data
    public function destroy(Register $register)
    {
        $register->delete();

        return redirect()->route('register.index')
                         ->with('success', 'Employee Deleted Successfully');
    }
}
