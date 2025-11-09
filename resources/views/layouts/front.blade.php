<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>@yield('title', 'Beranda') - {{ config('app.name', 'Sekolah') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Bootstrap --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <style>
    body { background-color: #f8fafc; }
    .navbar-brand img { max-height:32px; }
    .hero { background:white; padding:2rem 0; margin-bottom:1.5rem; border-bottom:1px solid #e5e7eb; }
    .teacher-photo{width:80px;height:80px;object-fit:cover;border-radius:8px}
    .news-cover{width:100%;height:160px;object-fit:cover;border-radius:.5rem}
  </style>

  @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
  <div class="container">
    <a class="navbar-brand" href="{{ route('front.home') }}">
      {{ config('app.name', 'Sekolah') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navFront">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navFront">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item {{ request()->routeIs('front.home') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('front.home') }}">Beranda</a>
        </li>
        <li class="nav-item {{ request()->routeIs('front.school') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('front.school') }}">Profil Sekolah</a>
        </li>
        <li class="nav-item {{ request()->routeIs('front.teachers') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('front.teachers') }}">Guru</a>
        </li>
        <li class="nav-item {{ request()->routeIs('front.extracurriculars') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('front.extracurriculars') }}">Ekstrakurikuler</a>
        </li>
        <li class="nav-item {{ request()->routeIs('front.news.*') ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('front.news.index') }}">Berita</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="py-4">
  @yield('content')
</main>

<footer class="border-top py-3 bg-white">
  <div class="container small text-muted text-center">
    &copy; {{ date('Y') }} {{ config('app.name', 'Sekolah') }}. All rights reserved.
  </div>
</footer>

<script src="https://kit.fontawesome.com/a2e0e6ad0e.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
