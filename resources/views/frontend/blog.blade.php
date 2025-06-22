@extends('frontend.layouts.main')
@section('content')
<section id="pricing" class="pricing section">
    <!-- Blog Kesehatan Hewan Section -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Blog</h2>
      <p>Tips dan informasi untuk perawatan hewan peliharaan</p>
    </div>
    <div class="container mt-2" data-aos="fade-up">
      <div class="row gy-4">
        @if($blogs->count() > 0)
          @foreach($blogs as $blog)
          <div class="col-lg-3 col-md-6">
            <div class="blog-card">
              <div class="blog-img">
                @if($blog->image)
                  <img src="{{ $blog->image_url }}" class="img-fluid" alt="{{ $blog->judul }}">
                @else
                  <img src="{{ asset('medicio/assets/img/blog/blog1.png') }}" class="img-fluid" alt="{{ $blog->judul }}">
                @endif
              </div>
              <div class="blog-content">
                <h3><a href="{{ route('blog.detail', $blog->id) }}">{{ $blog->judul }}</a></h3>
                <p>{{ Str::limit(strip_tags($blog->content), 120) }}</p>
                <a href="{{ route('blog.detail', $blog->id) }}" class="read-more">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>
          @endforeach
        @else
          <!-- Fallback content jika tidak ada blog -->
          <div class="col-lg-3 col-md-6">
            <div class="blog-card">
              <div class="blog-img">
                <img src="{{ asset('medicio/assets/img/blog/blog2.png') }}" class="img-fluid" alt="Vaksinasi Hewan">
              </div>
              <div class="blog-content">
                <h3><a href="#">Pentingnya Vaksinasi Rutin Hewan Peliharaan</a></h3>
                <p>Pelajari jadwal vaksinasi yang tepat untuk menjaga kesehatan hewan kesayangan Anda...</p>
                <a href="#" class="read-more">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="blog-card">
              <div class="blog-img">
                <img src="{{ asset('medicio/assets/img/blog/blog1.png') }}" class="img-fluid" alt="Grooming DIY">
              </div>
              <div class="blog-content">
                <h3><a href="#">Tips Grooming Mandiri untuk Kucing di Rumah</a></h3>
                <p>Panduan lengkap merawat bulu kucing dengan alat sederhana di rumah...</p>
                <a href="#" class="read-more">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="blog-card">
              <div class="blog-img">
                <img src="{{ asset('medicio/assets/img/blog/blog3.jpg') }}" class="img-fluid" alt="Makanan Sehat">
              </div>
              <div class="blog-content">
                <h3><a href="#">Pola Makan Sehat untuk Anjing Semua Usia</a></h3>
                <p>Ketahui kebutuhan nutrisi anjing Anda berdasarkan usia dan aktivitas harian...</p>
                <a href="#" class="read-more">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-6">
            <div class="blog-card">
              <div class="blog-img">
                <img src="{{ asset('medicio/assets/img/blog/blog4.png') }}" class="img-fluid" alt="Pertolongan Pertama">
              </div>
              <div class="blog-content">
                <h3><a href="#">Pertolongan Pertama Saat Hewan Keracunan</a></h3>
                <p>Langkah-langkah penting yang harus dilakukan sebelum membawa ke dokter hewan...</p>
                <a href="#" class="read-more">Baca Selengkapnya <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>
        @endif
      </div>

      <!-- Pagination -->
      @if($blogs->hasPages())
      <div class="row mt-4">
        <div class="col-12 text-center">
          {{ $blogs->links() }}
        </div>
      </div>
      @endif
    </div>
    </section>
@endsection
