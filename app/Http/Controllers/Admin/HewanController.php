<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Hewan;
use App\Models\User;

class HewanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $hewans = Hewan::with('user')->get();
        return view('admin.hewans.index', compact('hewans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('admin.hewans.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama' => 'required',
            'jenis' => 'required',
            'umur' => 'required|integer',
            'catatan' => 'nullable',
        ]);
        Hewan::create($validated);
        return redirect()->route('admin.hewans.index')->with('success', 'Hewan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hewan = Hewan::with('user')->findOrFail($id);
        return view('admin.hewans.show', compact('hewan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $hewan = Hewan::findOrFail($id);
        $users = User::all();
        return view('admin.hewans.edit', compact('hewan', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $hewan = Hewan::findOrFail($id);
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id',
            'nama' => 'required',
            'jenis' => 'required',
            'umur' => 'required|integer',
            'catatan' => 'nullable',
        ]);
        $hewan->update($validated);
        return redirect()->route('admin.hewans.index')->with('success', 'Hewan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hewan = Hewan::findOrFail($id);
        $hewan->delete();
        return redirect()->route('admin.hewans.index')->with('success', 'Hewan berhasil dihapus');
    }
}
