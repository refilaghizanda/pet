@extends('frontend.layouts.main')
@section('content')
    <section id="about" class="about section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Tentang Kami<br></h2>
        </div>

        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
                    <img src="{{ asset('medicio/assets/img/abt.png') }}" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
                    <!-- <h3>Voluptatem dignissimos provident quasi corporis voluptates sit assumenda.</h3>  -->
                    <p style="text-align: justify;">
                        <span style="font-weight: bold;">Petcare Ngunut</span> adalah klinik hewan dan layanan perawatan
                        peliharaan yang beroperasi sejak 2017 di Kecamatan Ngunut, Kabupaten Tulungagung. Berkomitmen
                        memberikan pelayanan kesehatan untuk hewan kesayangan Anda dilengkapi fasilitas medis dan tim dokter
                        hewan berpengalaman untuk memastikan hewan peliharaan Anda selalu sehat dan bahagia.
                    </p>
                    <ul>
                        <li><span style="font-weight: bold;">Fokus Layanan Kami:</span></li>
                        <li><i class="bi bi-check-all"></i> <span>Pemeriksaan kesehatan umum.</span></li>
                        <li><i class="bi bi-check-all"></i> <span>Vaksinasi dan program pencegahan penyakit.</span></li>
                        <li><i class="bi bi-check-all"></i> <span>Grooming profesional dan perawatan kebersihan.</span></li>
                        <li><i class="bi bi-check-all"></i> <span>Penitipan hewan yang bersih, aman dan nyaman.</span></li>
                    </ul>
                    <!-- <p>
                Dengan pengalaman melayani berbagai pasien hewan di Kecamatan Ngunut, Kabupaten Tulungagung, kami hadir untuk mendukung kesejahteraan hewan dan ketenangan pemiliknya. Setiap hewan diperlakukan dengan kasih sayang layaknya keluarga.
              </p> -->
                    <ul>
                        <li><span style="text-align: justify;"><span style="font-weight: bold;">Visi kami </span> menjadikan
                                Petcare Ngunut pusat layanan petcare terpercaya di Tulungagung dengan standar medis tinggi.
                                <span style="font-weight: bold;">Misi kami</span> memberikan edukasi dan solusi kesehatan
                                terjangkau untuk hewan peliharaan.</span></li>
                </div>
            </div>
        </div>
    </section>
    <!-- gallery section -->
    <section id="gallery" class="gallery section">
        <div class="container section-title" data-aos="fade-up">
            <h2>Galeri</h2>
        </div>
        <!-- swiper js  -->
        <div class="container" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper init-swiper">
                <script type="application/json" class="swiper-config">
          {
            "loop": true,
            "speed": 600,
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": "auto",
            "centeredSlides": true,
            "pagination": {
              "el": ".swiper-pagination",
              "type": "bullets",
              "clickable": true
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "spaceBetween": 0
              },
              "768": {
                "slidesPerView": 3,
                "spaceBetween": 20
              },
              "1200": {
                "slidesPerView": 5,
                "spaceBetween": 20
              }
            }
          }
        </script>
                <div class="swiper-wrapper align-items-center">
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('medicio/assets/img/gallery/gallery-3.PNG') }}"><img src="{{ asset('medicio/assets/img/gallery/gallery-3.PNG') }}"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('medicio/assets/img/gallery/gallery-4.PNG') }}"><img src="{{ asset('medicio/assets/img/gallery/gallery-4.PNG') }}"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('medicio/assets/img/gallery/gallery-5.PNG') }}"><img src="{{ asset('medicio/assets/img/gallery/gallery-5.PNG') }}"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('medicio/assets/img/gallery/gallery-6.jpg') }}"><img src="{{ asset('medicio/assets/img/gallery/gallery-6.jpg') }}"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('medicio/assets/img/gallery/gallery-7.PNG') }}"><img src="{{ asset('medicio/assets/img/gallery/gallery-7.PNG') }}"
                                class="img-fluid" alt=""></a></div>
                    <div class="swiper-slide"><a class="glightbox" data-gallery="images-gallery"
                            href="{{ asset('medicio/assets/img/gallery/gallery-8.PNG') }}"><img src="{{ asset('medicio/assets/img/gallery/gallery-8.PNG') }}"
                                class="img-fluid" alt=""></a></div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
@endsection
