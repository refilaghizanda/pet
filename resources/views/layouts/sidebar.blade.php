@php $role = Auth::user()->role ?? null; $route = request()->route()->getName(); @endphp
<ul class="navbar-nav sidebar sidebar-light accordion shadow-sm" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center py-3" href="{{ url('/') }}">
    <div class="sidebar-brand-icon">
      <img src="{{ asset('/medicio/assets/img/logo3.png') }}" style="height:40px;">
    </div>
    <div class="sidebar-brand-text mx-3 font-weight-bold">Petcare</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item {{ $route == ($role == 'admin' ? 'admin.dashboard' : 'pelanggan.dashboard') ? 'active' : '' }}">
    @if($role == 'admin')
      <a class="nav-link" href="{{ url('/admin/dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    @else
      <a class="nav-link" href="{{ url('/pelanggan/dashboard') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    @endif
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading text-secondary small">Menu Utama</div>
  @if($role == 'admin')
    <li class="nav-item {{ str_starts_with($route, 'admin.users') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.users.index') }}">
        <i class="fas fa-users"></i>
        <span>Manajemen User</span></a>
    </li>
    <li class="nav-item {{ str_starts_with($route, 'admin.hewans') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.hewans.index') }}">
        <i class="fas fa-dog"></i>
        <span>Data Hewan</span></a>
    </li>
    <li class="nav-item {{ str_starts_with($route, 'admin.layanans') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.layanans.index') }}">
        <i class="fas fa-briefcase-medical"></i>
        <span>Layanan</span></a>
    </li>
    <li class="nav-item {{ str_starts_with($route, 'admin.pesanans') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.pesanans.index') }}">
        <i class="fas fa-file-invoice"></i>
        <span>Pesanan</span></a>
    </li>
    <li class="nav-item {{ str_starts_with($route, 'admin.transaksis') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.transaksis.index') }}">
        <i class="fas fa-money-check-alt"></i>
        <span>Transaksi</span></a>
    </li>
    <li class="nav-item {{ str_starts_with($route, 'admin.blogs') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.blogs.index') }}">
        <i class="fas fa-blog"></i>
        <span>Blog</span></a>
    </li>
    <li class="nav-item {{ str_starts_with($route, 'admin.testimonials') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('admin.testimonials.index') }}">
        <i class="fas fa-comments"></i>
        <span>Testimonial</span></a>
    </li>
  @elseif($role == 'pelanggan')
    <li class="nav-item {{ $route == 'pelanggan.profile.edit' ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('pelanggan.profile.edit') }}">
        <i class="fas fa-user"></i>
        <span>Profil Saya</span></a>
    </li>
    <li class="nav-item {{ str_starts_with($route, 'pelanggan.hewans') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('pelanggan.hewans.index') }}">
        <i class="fas fa-dog"></i>
        <span>Hewan Saya</span></a>
    </li>
    <li class="nav-item {{ str_starts_with($route, 'pelanggan.pesanans') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('pelanggan.pesanans.index') }}">
        <i class="fas fa-file-invoice"></i>
        <span>Pesanan Saya</span></a>
    </li>
    <li class="nav-item {{ str_starts_with($route, 'pelanggan.transaksis') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('pelanggan.transaksis.index') }}">
        <i class="fas fa-money-check-alt"></i>
        <span>Transaksi Saya</span></a>
    </li>
    <li class="nav-item {{ str_starts_with($route, 'pelanggan.testimonials') ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('pelanggan.testimonials.index') }}">
        <i class="fas fa-comments"></i>
        <span>Testimonial Saya</span></a>
    </li>
  @endif

</ul>
