@extends('layouts.admin')

@section('title', $news->title)

@section('main-content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div>
      <h1 class="h3 mb-0 text-gray-800">{{ $news->title }}</h1>
      <div class="text-muted small mt-1">
        @if($news->date)
          <i class="far fa-calendar-alt mr-1"></i>
          {{ \Carbon\Carbon::parse($news->date)->translatedFormat('d F Y') }}
        @endif
        @if($news->author)
          <span class="mx-2">•</span>
          <i class="far fa-user mr-1"></i>{{ $news->author }}
        @endif
      </div>
    </div>

    <a href="{{ route('news.index') }}" class="btn btn-light border btn-sm">
      <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
  </div>

  <div class="card shadow">
    @if ($news->image)
      <div class="text-center p-3 pb-0">
        <img src="{{ asset('storage/'.$news->image) }}"
             alt="cover" class="img-fluid rounded"
             style="max-height: 360px; object-fit: cover;">
      </div>
    @endif

    <div class="card-body">
      {{-- Konten dari Rich Text Editor: aman ditampilkan sebagai HTML --}}
      <div class="prose">
        {!! $news->content !!}
      </div>
    </div>
  </div>
</div>
@endsection
