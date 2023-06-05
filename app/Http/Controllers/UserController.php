<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addAdmin(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:8',
        ]);

        $validate['password'] = bcrypt($validate['password']);
        $validate['role_id'] = 1;

        if (User::create($validate)) {
            return redirect()->back()->with('success', 'Berhasil menambahkan admin');
        }
    }

    public function deleteAdmin(Request $request, User $user)
    {
        if ($user->delete()) {
            return redirect()->back()->with('success', 'Berhasil menghapus admin');
        }
    }

    public function updateAdmin(Request $request, User $user)
    {
        if ($request->username == $user->username) {
            $validate = $request->validate([
                'username' => 'required'
            ]);
        } else {
            $validate = $request->validate([
                'username' => 'required|unique:users,username'
            ]);
        }

        if ($request->password) {
            $validate['password'] = bcrypt($request->password);
        }

        if ($user->update($validate)) {
            return redirect()->back()->with('success', 'Berhasil mengubah admin');
        }
    }

    public function addSales(Request $request)
    {
        $validate = $request->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|unique:users,email',
            'phone_number' => 'required|unique:users,phone_number',
            'address' => 'required',
            'full_name' => 'required',
            'password' => 'required|min:8',
        ]);

        $validate['status'] = 'active';
        $validate['password'] = bcrypt($validate['password']);
        $validate['role_id'] = 2;

        if (User::create($validate)) {
            return redirect()->back()->with('success', 'Berhasil menambahkan sales');
        }
    }

    public function changeStatusSales(Request $request, User $user)
    {
        if ($user->status == 'active') {
            $user->status = 'non active';
        } else {
            $user->status = 'active';
        }

        if ($user->save()) {
            return redirect()->back()->with('success', 'Berhasil mengubah status sales');
        }
    }

    public function updateSales(Request $request, User $user)
    {
        if ($request->username == $user->username) {
            $validate = $request->validate([
                'username' => 'required',
                'address' => 'required',
                'full_name' => 'required',
            ]);
        } else {
            $validate = $request->validate([
                'username' => 'required|unique:users,username',
                'address' => 'required',
                'full_name' => 'required',
            ]);
        }

        if ($request->email == $user->email) {
            $request->validate([
                'email' => 'required',
            ]);
            $validate['email'] = $request->email;
        } else {
            $request->validate([
                'email' => 'required|unique:users,email',
            ]);
            $validate['email'] = $request->email;
        }

        if ($request->phone_number == $user->phone_number) {
            $request->validate([
                'phone_number' => 'required',
            ]);
            $validate['phone_number'] = $request->phone_number;
        } else {
            $request->validate([
                'phone_number' => 'required|unique:users,phone_number',
            ]);
            $validate['phone_number'] = $request->phone_number;
        }

        if ($request->password) {
            $validate['password'] = bcrypt($request->password);
        }

        if ($user->update($validate)) {
            return redirect()->route('salesDetailAdmin', $user->id)->with('success', 'Berhasil mengubah sales');

            // $users = User::where('role_id', 2)->get();
            // return view('admin.sales', compact('users'))->with('success', 'Berhasil mengubah sales');
        }
    }

    public function updateMe(Request $request, User $user)
    {
        if ($request->username == $user->username) {
            $validate = $request->validate([
                'username' => 'required',
                'address' => 'required',
                'full_name' => 'required',
            ]);
        } else {
            $validate = $request->validate([
                'username' => 'required|unique:users,username',
                'address' => 'required',
                'full_name' => 'required',
            ]);
        }

        if ($request->email == $user->email) {
            $request->validate([
                'email' => 'required',
            ]);
            $validate['email'] = $request->email;
        } else {
            $request->validate([
                'email' => 'required|unique:users,email',
            ]);
            $validate['email'] = $request->email;
        }

        if ($request->phone_number == $user->phone_number) {
            $request->validate([
                'phone_number' => 'required',
            ]);
            $validate['phone_number'] = $request->phone_number;
        } else {
            $request->validate([
                'phone_number' => 'required|unique:users,phone_number',
            ]);
            $validate['phone_number'] = $request->phone_number;
        }

        if ($request->password) {
            $validate['password'] = bcrypt($request->password);
        }

        if ($user->update($validate)) {
            return redirect()->back()->with('success', 'Berhasil mengubah sales');

            // $users = User::where('role_id', 2)->get();
            // return view('admin.sales', compact('users'))->with('success', 'Berhasil mengubah sales');
        }
    }
}
