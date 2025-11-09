@extends('layouts.front')

@section('title', 'Beranda')

@section('content')
<div class="hero">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-md-8">
        <h1 class="h3 mb-2">{{ $school->name ?? 'Nama Sekolah' }}</h1>
        @if($school && $school->description)
          <p class="text-muted mb-2">{{ $school->description }}</p>
        @endif
        <div class="small text-muted">
          @if($school && $school->address) <span class="mr-3"><i class="fas fa-map-marker-alt"></i> {{ $school->address }}</span>@endif
          @if($school && $school->phone)   <span class="mr-3"><i class="fas fa-phone"></i> {{ $school->phone }}</span>@endif
          @if($school && $school->email)   <span class="mr-3"><i class="fas fa-envelope"></i> {{ $school->email }}</span>@endif
        </div>
      </div>
      <div class="col-md-4 text-md-right mt-3 mt-md-0">
        @if($school && $school->logo)
          <img src="{{ asset('storage/'.$school->logo) }}" alt="logo sekolah" class="img-fluid" style="max-height:120px">
        @endif
      </div>
    </div>
  </div>
</div>

<div class="container">

  {{-- Berita Terbaru --}}
  <section class="mb-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h2 class="h5 mb-0">Berita Terbaru</h2>
      <a href="{{ route('front.news.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="row">
      @forelse($latestNews as $n)
        <div class="col-md-4 mb-3">
          <div class="card h-100">
            @if($n->image)
              <img src="{{ asset('storage/'.$n->image) }}" class="news-cover" alt="cover">
            @endif
            <div class="card-body">
              <div class="small text-muted">
                {{ $n->date ? \Carbon\Carbon::parse($n->date)->format('d/m/Y') : '' }}
              </div>
              <h5 class="card-title mb-1">
                <a href="{{ route('front.news.show', $n) }}">{{ $n->title }}</a>
              </h5>
              <div class="small text-muted">{{ $n->author }}</div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-muted">Belum ada berita.</div>
      @endforelse
    </div>
  </section>

  {{-- Guru --}}
  <section class="mb-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h2 class="h5 mb-0">Guru</h2>
      <a href="{{ route('front.teachers') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="row">
      @forelse($teachers as $t)
        <div class="col-6 col-md-4 col-lg-2 mb-3">
          <div class="text-center">
            @if($t->photo)
              <img src="{{ asset('storage/'.$t->photo) }}" class="teacher-photo mb-2" alt="{{ $t->name }}">
            @else
              <img src="https://ui-avatars.com/api/?name={{ urlencode($t->name) }}&size=120" class="teacher-photo mb-2" alt="{{ $t->name }}">
            @endif
            <div class="font-weight-bold small">{{ $t->name }}</div>
            <div class="small text-muted">{{ $t->position ?? 'Guru' }}</div>
          </div>
        </div>
      @empty
        <div class="col-12 text-muted">Belum ada data guru.</div>
      @endforelse
    </div>
  </section>

  {{-- Ekstrakurikuler --}}
  <section class="mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
      <h2 class="h5 mb-0">Ekstrakurikuler</h2>
      <a href="{{ route('front.extracurriculars') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
    </div>
    <div class="row">
      @forelse($extracurriculars as $x)
        <div class="col-md-4 mb-3">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title mb-1">{{ $x->name }}</h5>
              <div class="small text-muted mb-2">
                Pembina: {{ $x->teacher->name ?? '—' }} @if($x->schedule) • {{ $x->schedule }} @endif
              </div>
              @if($x->description)
                <p class="card-text text-muted mb-0">{{ \Illuminate\Support\Str::limit($x->description, 100) }}</p>
              @endif
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-muted">Belum ada ekstrakurikuler.</div>
      @endforelse
    </div>
  </section>

</div>
@endsection
