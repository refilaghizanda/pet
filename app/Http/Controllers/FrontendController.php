<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Layanan;
use App\Models\Testimonial;

class FrontendController extends Controller
{
    public function index()
    {
        $layanans = Layanan::all();
        $testimonials = Testimonial::with('user')->latest()->take(6)->get();
        return view('frontend.index', compact('layanans', 'testimonials'));
    }
    public function about()
    {
        return view('frontend.about');
    }
    public function services()
    {
        $layanans = Layanan::all();
        return view('frontend.services', compact('layanans'));
    }
    public function blog()
    {
        $blogs = Blog::latest()->paginate(8);
        return view('frontend.blog', compact('blogs'));
    }
    public function blogDetail($id)
    {
        $blog = Blog::findOrFail($id);
        $recentBlogs = Blog::where('id', '!=', $id)
                          ->latest()
                          ->take(3)
                          ->get();
        return view('frontend.blogdetails', compact('blog', 'recentBlogs'));
    }
    public function faq()
    {
        return view('frontend.faq');
    }
}
