@extends('layouts.front')

@section('title', 'Profil Sekolah')

@section('content')
<div class="container">
  <h1 class="h3 mb-3">Profil Sekolah</h1>

  @if($school)
    <div class="row">
      <div class="col-md-4 mb-3">
        @if($school->logo)
          <img src="{{ asset('storage/'.$school->logo) }}" class="img-fluid mb-3" alt="logo sekolah">
        @endif
        <ul class="list-unstyled small text-muted">
          @if($school->address) <li><i class="fas fa-map-marker-alt"></i> {{ $school->address }}</li>@endif
          @if($school->phone)   <li><i class="fas fa-phone"></i> {{ $school->phone }}</li>@endif
          @if($school->email)   <li><i class="fas fa-envelope"></i> {{ $school->email }}</li>@endif
        </ul>
      </div>
      <div class="col-md-8">
        <h2 class="h4">{{ $school->name }}</h2>
        @if($school->description)
          <p>{{ $school->description }}</p>
        @else
          <p class="text-muted">Deskripsi sekolah belum diisi.</p>
        @endif
      </div>
    </div>
  @else
    <p class="text-muted">Data sekolah belum diisi.</p>
  @endif
</div>
@endsection
