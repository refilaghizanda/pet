@extends('frontend.layouts.main')
@section('content')
<section class="register-section">
    <div class="container" data-aos="fade-up">
      <div class="register-card">
        <h2 class="register-title">Buat Akun Baru</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="name" class="form-label">Nama Lengkap</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" name="username" id="username" placeholder="Buat username" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="no_telepon" class="form-label">Nomor Telepon</label>
            <input type="tel" class="form-control" name="no_telepon" id="no_telepon" placeholder="Masukkan nomor telepon" required>
          </div>
          <div class="mb-3">
            <label for="alamat" class="form-label">Alamat Rumah</label>
            <textarea class="form-control" name="alamat" id="alamat" rows="2" placeholder="Masukkan alamat lengkap" required></textarea>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Buat password" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="confirm-password" class="form-label">Konfirmasi Password</label>
              <input type="password" name="password_confirmation" class="form-control" id="confirm-password" placeholder="Ulangi password" required>
              <div class="password-match">Password cocok!</div>
              <div class="password-mismatch">Password tidak cocok!</div>
            </div>
          </div>
          <input type="hidden" name="role" value="pelanggan">
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="terms" required>
            <label class="form-check-label" for="terms">Saya menyetujui <a href="#">Syarat dan Ketentuan</a> serta <a href="#">Kebijakan Privasi</a></label>
          </div>
          <button type="submit" class="btn btn-register">Daftar</button>
          <div class="login-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk disini</a>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection
