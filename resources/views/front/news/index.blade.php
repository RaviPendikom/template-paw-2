@extends('layouts.front')

@section('title', 'Berita')

@section('content')
<div class="container">
  <h1 class="h3 mb-3">Berita</h1>

  <div class="row">
    @forelse($news as $n)
      <div class="col-md-4 mb-4">
        <div class="card h-100">
          @if($n->image)
            <img src="{{ asset('storage/'.$n->image) }}" class="news-cover" alt="cover">
          @endif
          <div class="card-body">
            <div class="small text-muted mb-1">
              {{ $n->date ? \Carbon\Carbon::parse($n->date)->format('d/m/Y') : '' }}
            </div>
            <h5 class="card-title mb-1">
              <a href="{{ route('front.news.show', $n) }}">{{ $n->title }}</a>
            </h5>
            <div class="small text-muted mb-2">{{ $n->author }}</div>
            <p class="card-text text-muted">
              {{ \Illuminate\Support\Str::limit(strip_tags($n->content), 120) }}
            </p>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-muted">Belum ada berita.</div>
    @endforelse
  </div>

  <div>
    {{ $news->links() }}
  </div>
</div>
@endsection
