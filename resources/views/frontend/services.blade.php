@extends('frontend.layouts.main')
@section('content')
<section id="pricing" class="pricing section">
    <div class="container section-title" data-aos="fade-up">
      <h2>Layanan</h2>
      <p>Detail deskripsi dan harga layanan</p>
    </div>

    <div class="container">
      <div class="row gy-3">
        @if($layanans->count() > 0)
          @foreach($layanans as $layanan)
          <div class="col-xl-4 col-lg-6" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
            <div class="pricing-item featured">
              <h3>{{ $layanan->nama }}</h3>
              <h4><sup>Rp</sup>{{ number_format($layanan->harga, 0, ',', '.') }}</h4>
              <ul>
                @if($layanan->deskripsi)
                  @php
                    $descriptions = explode('.', $layanan->deskripsi);
                    $descriptions = array_filter($descriptions, function($desc) {
                      return trim($desc) !== '';
                    });
                  @endphp
                  @foreach(array_slice($descriptions, 0, 4) as $desc)
                    <li>{{ trim($desc) }}.</li>
                  @endforeach
                @else
                  <li>Layanan berkualitas tinggi.</li>
                  <li>Dilakukan oleh tenaga profesional.</li>
                  <li>Hasil yang memuaskan.</li>
                  <li>Garansi layanan.</li>
                @endif
              </ul>
              <div class="btn-wrap">
                @auth
                  @if(auth()->user()->role == 'pelanggan')
                    <a href="{{ route('pelanggan.pesanans.create') }}" class="btn-buy">Pesan Sekarang</a>
                  @else
                    <a href="{{ route('login') }}" class="btn-buy">Pesan sekarang</a>
                  @endif
                @else
                  <a href="{{ route('login') }}" class="btn-buy">Pesan sekarang</a>
                @endauth
              </div>
            </div>
          </div>
          @endforeach
        @else
          <!-- Fallback content jika tidak ada layanan -->
          <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="pricing-item featured">
              <h3>Pemeriksaan Hewan</h3>
              <h4><sup>Rp</sup>250.000</h4>
              <ul>
                <li>Konsultasi kesehatan hewan dengan dokter profesional.</li>
                <li>Pemeriksaan fisik Lengkap.</li>
                <li>Diagnosis gejala penyakit atau keluhan.</li>
                <li>Rekomendasi pengobatan dan perawatan.</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Pesan Sekarang</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="pricing-item featured">
              <h3>Grooming</h3>
              <h4><sup>Rp</sup>150.000</h4>
              <ul>
                <li>Perawatan kebersihan hewan secara menyeluruh.</li>
                <li>Termasuk mandi, potong kuku, pembersihan telinga.</li>
                <li>Sisir bulu dan hilangkan kusut.</li>
                <li>Dilakukan oleh groomer berpengalaman.</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Pesan Sekarang</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="pricing-item featured">
              <h3>Vaksinasi</h3>
              <h4><sup>Rp</sup>150.000</h4>
              <ul>
                <li>Pemberian vaksin sesuai usia dan kebutuhan hewan.</li>
                <li>Vaksin wajib dan tambahan.</li>
                <li>Dibuktikan sertifikat vaksinasi resmi.</li>
                <li>Pantau reaksi hewan peliharaan pasca-vaksin.</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Pesan Sekarang</a>
              </div>
            </div>
          </div>
          <div class="col-xl-3 col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="pricing-item featured">
              <h3>Penitipan Hewan</h3>
              <h4><sup>Rp</sup>50.000/hari</h4>
              <ul>
                <li>Tempat aman dan nyaman dengan pengawasan 24 jam.</li>
                <li>Makan dan minum teratur sesuai kebutuhan.</li>
                <li>Pemeriksaan kesehatan harian.</li>
                <li>Aktivitas bermain dan olahraga terjadwal.</li>
              </ul>
              <div class="btn-wrap">
                <a href="#" class="btn-buy">Pesan Sekarang</a>
              </div>
            </div>
          </div>
        @endif
      </div>
    </div>
</section>
@endsection
