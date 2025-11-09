@extends('layouts.front')

@section('title', 'Guru')

@section('content')
<div class="container">
  <h1 class="h3 mb-3">Daftar Guru</h1>

  <div class="row">
    @forelse($teachers as $t)
      <div class="col-6 col-md-4 col-lg-3 mb-4">
        <div class="card h-100 text-center">
          <div class="card-body">
            @if($t->photo)
              <img src="{{ asset('storage/'.$t->photo) }}" class="teacher-photo mb-2" alt="{{ $t->name }}">
            @else
              <img src="https://ui-avatars.com/api/?name={{ urlencode($t->name) }}&size=120" class="teacher-photo mb-2" alt="{{ $t->name }}">
            @endif
            <h5 class="card-title mb-1">{{ $t->name }}</h5>
            <div class="small text-muted">{{ $t->position ?? 'Guru' }}</div>
            @if($t->email)
              <div class="small text-muted mt-1"><i class="fas fa-envelope"></i> {{ $t->email }}</div>
            @endif
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-muted">Belum ada data guru.</div>
    @endforelse
  </div>

  <div>
    {{ $teachers->links() }}
  </div>
</div>
@endsection
