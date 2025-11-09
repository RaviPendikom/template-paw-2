@extends('layouts.front')

@section('title', $news->title)

@section('content')
<div class="container">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent px-0">
      <li class="breadcrumb-item"><a href="{{ route('front.news.index') }}">Berita</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $news->title }}</li>
    </ol>
  </nav>

  <h1 class="h3 mb-1">{{ $news->title }}</h1>
  <div class="small text-muted mb-3">
    @if($news->date)
      <i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($news->date)->translatedFormat('d F Y') }}
    @endif
    @if($news->author)
      <span class="mx-2">•</span><i class="far fa-user"></i> {{ $news->author }}
    @endif
  </div>

  @if($news->image)
    <div class="mb-3">
      <img src="{{ asset('storage/'.$news->image) }}" class="img-fluid rounded" alt="cover">
    </div>
  @endif

  <div class="bg-white p-3 rounded shadow-sm">
    {!! $news->content !!}
  </div>
</div>
@endsection
