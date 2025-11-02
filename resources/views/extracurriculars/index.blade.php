@extends('layouts.admin')

@section('title', 'Data Ekstrakurikuler')

@section('main-content')
<div class="container-fluid">
  <!-- Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Ekstrakurikuler</h1>
    <a href="{{ route('extracurriculars.create') }}" class="btn btn-primary btn-sm">
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
      <h6 class="m-0 font-weight-bold text-primary">Tabel Ekstrakurikuler</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped" width="100%">
          <thead class="thead-light">
            <tr>
              <th>Nama</th>
              <th>Guru Pembina</th>
              <th>Jadwal</th>
              <th style="width: 140px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($extracurriculars as $x)
              <tr>
                <td>{{ $x->name }}</td>
                <td>{{ $x->teacher->name ?? '—' }}</td>
                <td>{{ $x->schedule ?? '—' }}</td>
                <td>
                  <a href="{{ route('extracurriculars.edit', $x) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('extracurriculars.destroy', $x) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Hapus data ini? Tindakan tidak dapat dibatalkan.');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center text-muted">Belum ada data.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
