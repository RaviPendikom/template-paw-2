@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
    <a href="{{ route('teachers.create') }}" class="btn btn-primary btn-sm">
      <i class="fas fa-plus mr-1"></i> Tambah Guru
    </a>
  </div>

  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
  @endif

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Tabel Guru</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered table-striped" width="100%" cellspacing="0">
          <thead class="thead-light">
            <tr>
              <th style="width: 200px;">Foto</th> {{-- was 60px --}}
              <th>Nama</th>
              <th>NIP/NUPTK</th>
              <th>Email</th>
              <th>Jabatan</th>
              <th style="width: 140px;">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($teachers as $teacher)
              <tr>
                <td class="text-center">
                  @if ($teacher->photo)
                    <img
                      src="{{ asset('storage/'.$teacher->photo) }}"
                      alt="foto"
                      class="img-thumbnail"
                      style="width:120px; height:120px; object-fit:cover; border-radius:8px;">
                  @else
                    <img
                      src="https://ui-avatars.com/api/?name={{ urlencode($teacher->name) }}&size=160"
                      class="img-thumbnail"
                      style="width:80px; height:80px; object-fit:cover; border-radius:8px;">
                  @endif
                </td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->employee_number }}</td>
                <td>{{ $teacher->email ?? '—' }}</td>
                <td>{{ $teacher->position ?? '—' }}</td>
                <td>
                  <a href="{{ route('teachers.edit', $teacher) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                  </a>
                  <form action="{{ route('teachers.destroy', $teacher) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Hapus guru ini? Tindakan tidak dapat dibatalkan.');">
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
                <td colspan="6" class="text-center text-muted">Belum ada data guru.</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection
