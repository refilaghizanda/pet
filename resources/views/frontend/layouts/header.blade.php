<header id="header" class="header sticky-top">
    <div class="branding d-flex align-items-center">
      <div class="container position-relative d-flex align-items-center justify-content-end">
        <a href="{{ route('home') }}" class="logo d-flex align-items-center me-auto">
          <img src="{{ asset('medicio/assets/img/logo3.png') }}" alt="">
          <h1 class="sitename">PETCARE NGUNUT</h1>
        </a>
        <!-- navbar  -->
        <nav id="navmenu" class="navmenu mx-auto">
          <ul class="d-flex justify-content-center">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a></li>
            <li><a href="{{ route('services') }}" class="{{ request()->routeIs('services') ? 'active' : '' }}">Layanan</a></li>
            <li><a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a></li>
            <li><a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
        <!-- btn login  -->
        @if(Auth::check())
            <a class="cta-btn" href="{{ route('pelanggan.dashboard') }}">
                <i class="fas fa-user"></i>
                {{ Auth::user()->name }}
            </a>
        @else
            <a class="cta-btn" href="{{ route('login') }}">Masuk</a>
        @endif
      </div>
    </div>
  </header>
