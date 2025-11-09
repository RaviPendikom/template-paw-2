@extends('layouts.front')

@section('title', 'Ekstrakurikuler')

@section('content')
<div class="container">
  <h1 class="h3 mb-3">Ekstrakurikuler</h1>

  <div class="row">
    @forelse($extracurriculars as $x)
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h5 class="card-title mb-1">{{ $x->name }}</h5>
            <div class="small text-muted mb-2">
              Pembina: {{ $x->teacher->name ?? '—' }}
              @if($x->schedule) <br>Jadwal: {{ $x->schedule }} @endif
            </div>
            @if($x->description)
              <p class="card-text text-muted">{{ $x->description }}</p>
            @endif
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-muted">Belum ada ekstrakurikuler.</div>
    @endforelse
  </div>

  <div>
    {{ $extracurriculars->links() }}
  </div>
</div>
@endsection
