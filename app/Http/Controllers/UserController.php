<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        //superadmin /admin pust
        if(auth()->user()->role == 'admin'){
            $users = User::all();
         }else{

        // ADMIN CABANG
            $users = User::where(
                'id_outlet',
                auth()->user()->id_outlet
            )->get();

        }

        $outlets = Outlet::all();
        $pakets = Paket::all();

        return view('user.index', compact('users', 'outlets', 'pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
            'id_outlet' => 'nullable',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jk' => $request->jk,
            'id_outlet' => auth()->user()->role == 'admin'
                ? $request->id_outlet
                : auth()->user()->id_outlet,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->back()->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telepon = $request->telepon;
        $user->jk = $request->jk;
        if(auth()->user()->role == 'admin'){
             $user->id_outlet = $request->id_outlet;
        }
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (auth()->id() == $id) {
            return redirect()->back()->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        User::destroy($id);

        return redirect()->back()->with('success', 'Pengguna berhasil dihapus!');
    }
}