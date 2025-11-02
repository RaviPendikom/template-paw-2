@extends('layouts.admin')

@section('title', 'Data Berita')

@section('main-content')
<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Berita</h1>
    <a href="{{ route('news.create') }}" class="btn btn-primary btn-sm">
      <i class="fas fa-plus mr-1"></i> Tambah
    </a>
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span></button>
    </div>
  @endif

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tabel Berita</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped" width="100%">
          <thead class="thead-light">
            <tr>
              <th style="width: 80px;">Gambar</th>
              <th>Judul</th>
              <th>Tanggal</th>
              <th>Penulis</th>
              <th style="width: 140px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($news as $item)
              <tr>
                <td class="text-center">
                  @if ($item->image)
                    <img src="{{ asset('storage/'.$item->image) }}" style="width:70px;height:48px;object-fit:cover;border-radius:6px;">
                  @else
                    <div class="text-muted">—</div>
                  @endif
                </td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->date ? \Carbon\Carbon::parse($item->date)->format('d/m/Y') : '—' }}</td>
                <td>{{ $item->author ?? '—' }}</td>
                <td>
                   <a href="{{ route('news.show', $item) }}" class="btn btn-sm btn-info">
                      <i class="fas fa-eye"></i>
                    </a>
                  <a href="{{ route('news.edit', $item) }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                  <form action="{{ route('news.destroy', $item) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Hapus berita ini?');">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
            @empty
              <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
