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
        if (auth()->user()->role == 'admin') {
            $users = User::with('outlet')->orderBy('id', 'desc')->get();
        } else {
            $users = User::with('outlet')
                ->where('id_outlet', auth()->user()->id_outlet)
                ->orderBy('id', 'desc')
                ->get();
        }

        $outlets = Outlet::all();
        $pakets = Paket::all();

        return view('user.index', compact('users', 'outlets', 'pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:6',
            'role'      => 'required',
            'telepon'   => 'nullable|string|max:20|unique:users,telepon',
            'jk'        => 'nullable|string',
            'id_outlet' => 'nullable'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'jk' => $request->jk,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'id_outlet' => auth()->user()->role == 'admin'
                ? $request->id_outlet
                : auth()->user()->id_outlet,
        ]);

        return redirect()
            ->route('user.index')
            ->with('success', 'Pengguna berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'telepon' => 'nullable|string|max:20|unique:users,telepon',
            'jk' => 'nullable|string',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->telepon = $request->telepon;
        $user->jk = $request->jk;
        $user->role = $request->role;

        if (auth()->user()->role == 'admin') {
            $user->id_outlet = $request->id_outlet;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('user.index')
            ->with('success', 'Pengguna berhasil diperbarui!');
    }

    public function destroy($id)
    {
        if (auth()->id() == $id) {
            return redirect()
                ->route('user.index')
                ->with('error', 'Tidak bisa menghapus akun sendiri!');
        }

        User::destroy($id);

        return redirect()
            ->route('user.index')
            ->with('success', 'Pengguna berhasil dihapus!');
    }

    public function updateFoto(Request $request)
    {
        $user = User::findOrFail(auth()->id());

        if ($request->has('reset_foto')) {

            if ($user->foto && file_exists(public_path('foto_profil/' . $user->foto))) {
                @unlink(public_path('foto_profil/' . $user->foto));
            }

            $user->foto = null;
            $user->save();

            return back()->with('success', 'Profil berhasil dikembalikan ke semula!');
        }

        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->hasFile('foto')) {

            if ($user->foto && file_exists(public_path('foto_profil/' . $user->foto))) {
                @unlink(public_path('foto_profil/' . $user->foto));
            }

            $namaFoto = time() . '.' . $request->foto->extension();

            $request->foto->move(
                public_path('foto_profil'),
                $namaFoto
            );

            $user->foto = $namaFoto;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}