@extends('frontend.layouts.main')
@section('content')
<section class="login-section">
    <div class="container" data-aos="fade-up">
      <div class="login-card">
        <h2 class="login-title">Masuk ke Akun Anda</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan username Anda" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan password Anda" required>
          </div>
          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="remember">
            <label class="form-check-label" for="remember">Ingat saya</label>
          </div>
          <button type="submit" class="btn btn-login">Masuk</button>
          <div class="register-link">
            Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a>
          </div>
        </form>
      </div>
    </div>
  </section>
@endsection
