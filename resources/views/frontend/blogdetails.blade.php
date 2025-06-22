@extends('frontend.layouts.main')
@section('content')
<section id="about" class="about section">
    <div class="container section-title" data-aos="fade-up">
      <h2>{{ $blog->judul ?? 'Judul Blog' }}<br></h2>
    </div>

    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
          @if(isset($blog) && $blog->image)
            <img src="{{ $blog->image_url }}" class="img-fluid" alt="{{ $blog->judul }}">
          @else
            <img src="assets/img/blog/blog1.png" class="img-fluid" alt="">
          @endif
        </div>
        <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
          @if(isset($blog))
            <div style="text-align: justify;">
              {!! $blog->content !!}
            </div>
            <div class="mt-3">
              <small class="text-muted">
                <i class="bi bi-calendar"></i> {{ $blog->created_at->format('d F Y') }}
              </small>
            </div>
          @else
            <p style="text-align: justify;">
                Merawat bulu kucing secara rutin tidak hanya membuatnya terlihat lebih cantik, tetapi juga menjaga kesehatan kulit dan mengurangi risiko bulu rontok berlebihan. Dengan alat sederhana yang ada di rumah, Anda bisa melakukan grooming mandiri untuk kucing kesayangan.
            </p>
          @endif
        </div>
      </div>
    </div>
  </section>
@endsection
