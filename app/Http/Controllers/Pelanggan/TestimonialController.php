<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('user_id', Auth::user()->id)->latest()->get();
        return view('pelanggan.testimonials.index', compact('testimonials'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'isi' => 'required|string|max:500'
        ]);

        Testimonial::create([
            'user_id' => Auth::user()->id,
            'isi' => $request->isi
        ]);

        return redirect()->route('pelanggan.testimonials.index')
            ->with('success', 'Testimonial berhasil ditambahkan!');
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        // Pastikan testimonial milik user yang sedang login
        if ($testimonial->user_id !== Auth::user()->id) {
            abort(403);
        }

        $request->validate([
            'isi' => 'required|string|max:500'
        ]);

        $testimonial->update([
            'isi' => $request->isi
        ]);

        return redirect()->route('pelanggan.testimonials.index')
            ->with('success', 'Testimonial berhasil diperbarui!');
    }

    public function destroy(Testimonial $testimonial)
    {
        // Pastikan testimonial milik user yang sedang login
        if ($testimonial->user_id !== Auth::user()->id) {
            abort(403);
        }

        $testimonial->delete();

        return redirect()->route('pelanggan.testimonials.index')
            ->with('success', 'Testimonial berhasil dihapus!');
    }
}
