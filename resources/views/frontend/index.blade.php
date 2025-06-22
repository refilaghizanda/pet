@extends('frontend.layouts.main')
@section('content')
<section id="call-to-action" class="call-to-action section accent-background">
    <div class="container">
      <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
        <div class="col-xl-10">
          <div class="text-center">
            <h3>Rawat & Sayangi Hewan Peliharaan Anda dengan Praktis <br/> Pesan Online Sekarang, Antar-Jemput Gratis!</h3> <br/>
            <p>Kami Menyediakan Layanan Perawatan untuk Hewan Peliharaan Anda, dengan Sentuhan Kasih dan Kualitas yang Terpercaya. <br/> Karena Kesehatan Mereka adalah Kebahagiaan Anda dan Kami Hadir untuk Mendukung Setiap Momen Bersama.</p>            </div>
        </div>
      </div>
    </div>
  </section>

  <!-- services section -->
  <section id="services" class="services section">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="fas fa-mobile-alt"></i>
            </div>
              <h3>Mudah</h3>
            <p>Tidak punya waktu datang ke tempat? <br/> Jangan panik! Pesan layanan melalui website dan kami segera menjemput hewan kesayangan Anda.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="fas fa-wallet"></i>
            </div>
              <h3>Hemat</h3>
            <p>Khawatir dengan biaya antar-jemput? Tenang! Layanan kami bebas biaya untuk hewan kesayangan Anda.</p>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
          <div class="service-item position-relative">
            <div class="icon">
              <i class="fas fa-heart"></i>
            </div>
              <h3>Terpercaya</h3>
            <p>Masih ragu dengan PetCare Ngunut? Gampang! Scroll website ini ke bawah untuk melihat testimoni terpercaya dari pelanggan kami.</p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- tabs section -->
  <section id="tabs" class="tabs section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Layanan</h2>
      <p>Apa saja layanan yang kami sediakan?</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <div class="row">
        <div class="col-lg-3">
          <ul class="nav nav-tabs flex-column">
            <li class="nav-item">
              <a class="nav-link active show" data-bs-toggle="tab" href="#tabs-tab-1">Pemeriksaan Hewan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-2">Grooming</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-3">Vaksinasi</a>
            </li>
            {{-- <li class="nav-item">
              <a class="nav-link" data-bs-toggle="tab" href="#tabs-tab-4">Penitipan Hewan</a>
            </li> --}}
          </ul>
        </div>
        <div class="col-lg-9 mt-4 mt-lg-0">
          <div class="tab-content">
            <div class="tab-pane active show" id="tabs-tab-1">
              <div class="row">
                <div class="col-lg-8 details order-2 order-lg-1">
                  <h3>Pemeriksaan Hewan</h3>
                  <p>Kami melayani pemeriksaan hewan kesayangan Anda secara profesional dengan peralatan medis lengkap dan tim dokter hewan berpengalaman. Deteksi dini masalah kesehatan, dapatkan penanganan tepat, dan jaga kualitas hidup terbaik untuk sahabat berbulu Anda!</p>
                </div>
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  <img src="{{ asset('medicio/assets/img/departments-3.png') }}" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tabs-tab-2">
              <div class="row">
                <div class="col-lg-8 details order-2 order-lg-1">
                  <h3>Grooming</h3>
                  <p>Kami melayani grooming lengkap untuk hewan kesayangan Anda dengan peralatan steril dan produk premium. Mulai dari mandi, potong bulu, hingga perawatan kuku - kami membuat mereka bersih, wangi, dan nyaman!</p>
                </div>
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  <img src="{{ asset('medicio/assets/img/departments-2.png') }}" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tabs-tab-3">
              <div class="row">
                <div class="col-lg-8 details order-2 order-lg-1">
                  <h3>Vaksinasi</h3>
                  <p>Kami menyediakan layanan vaksinasi untuk melindungi hewan kesayangan Anda dari penyakit berbahaya dengan vaksinasi lengkap. Jadwal fleksibel, rekam medis digital, dan konsultasi pasca-vaksinasi GRATIS!</p>
                </div>
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  <img src="{{ asset('medicio/assets/img/departments-1.png') }}" alt="" class="img-fluid">
                </div>
              </div>
            </div>
            <div class="tab-pane" id="tabs-tab-4">
              <div class="row">
                <div class="col-lg-8 details order-2 order-lg-1">
                  <h3>Penitipan Hewan</h3>
                  <p>Kami menyediakan fasilitas penitipan hewan dengan kandang bersih, CCTV 24 jam, dan pendampingan oleh pet sitter berpengalaman. Jadikan liburan Anda tenang tanpa khawatir! </p>
                </div>
                <div class="col-lg-4 text-center order-1 order-lg-2">
                  <img src="{{ asset('medicio/assets/img/departments-4.png') }}" alt="" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- testimoni section -->
  <section id="testimonials" class="testimonials section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Testimonial</h2>
      <p>Bagaimana pendapat mereka tentang layanan kami?</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
      <!-- swiper js  -->
      <div class="swiper init-swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
        <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "spaceBetween": 40
              },
              "1200": {
                "slidesPerView": 3,
                "spaceBetween": 20
              }
            }
          }
        </script>
        <div class="swiper-wrapper">
          @if($testimonials->count() > 0)
            @foreach($testimonials as $testimonial)
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>{{ $testimonial->isi }}</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="{{ asset('medicio/assets/img/testimonials/testimonials-1.png') }}" class="testimonial-img" alt="">
                <h3>{{ $testimonial->user->name }}</h3>
              </div>
            </div>
            @endforeach
          @else
            <!-- Fallback content jika tidak ada testimonial -->
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Petcare Ngunut memang ini memang pelayanannya bagus. Mantap!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="{{ asset('medicio/assets/img/testimonials/testimonials-1.png') }}" class="testimonial-img" alt="">
                <h3>Rindya Astri</h3>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Selalu aman menitipkan hewan disini. The best!</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="{{ asset('medicio/assets/img/testimonials/testimonials-1.png') }}" class="testimonial-img" alt="">
                <h3>Marsha Nora</h3>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Dokternya mujarap. Karyawan ramah. Harga oke</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="{{ asset('medicio/assets/img/testimonials/testimonials-1.png') }}" class="testimonial-img" alt="">
                <h3>Ayun M</h3>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Gampang banget pembayarannya bisa cashless. Nice lah.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="{{ asset('medicio/assets/img/testimonials/testimonials-1.png') }}" class="testimonial-img" alt="">
                <h3>Bayu Prasetio</h3>
              </div>
            </div>
            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Langganan soalnya bisa jemput bola pas kita lagi repot.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="{{ asset('medicio/assets/img/testimonials/testimonials-1.png') }}" class="testimonial-img" alt="">
                <h3>Fizio Ramadhan</h3>
              </div>
            </div>
          @endif
        </div>
        <div class="swiper-pagination"></div>
      </div>
    </div>
  </section>
@endsection
