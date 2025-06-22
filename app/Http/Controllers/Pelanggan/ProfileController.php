<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('pelanggan.profile', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('pelanggan.edit_profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $validated = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'no_telepon' => 'nullable',
            'alamat' => 'nullable',
            'password' => 'nullable|min:6',
        ]);
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        $user->no_telepon = $validated['no_telepon'];
        $user->alamat = $validated['alamat'];
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();
        return redirect()->route('pelanggan.profile.edit')->with('success', 'Profil berhasil diupdate');
    }
}
