@extends('layouts.admin')

@section('title', 'Tambah Ekstrakurikuler')

@section('main-content')
<div class="container-fluid">
  <!-- Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Ekstrakurikuler</h1>
    <a href="{{ route('extracurriculars.index') }}" class="btn btn-light border btn-sm">
      <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <div class="font-weight-bold mb-1">Terjadi kesalahan:</div>
      <ul class="mb-0">
        @foreach ($errors->all() as $e) <li>{{ $e }}</li> @endforeach
      </ul>
    </div>
  @endif

  <div class="card shadow">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Form Ekstrakurikuler</h6>
    </div>
    <div class="card-body">
      <form action="{{ route('extracurriculars.store') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="name">Nama <span class="text-danger">*</span></label>
          <input type="text" name="name" id="name"
                 value="{{ old('name') }}" required maxlength="100"
                 class="form-control @error('name') is-invalid @enderror">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <label for="teacher_id">Guru Pembina <span class="text-danger">*</span></label>
          <select name="teacher_id" id="teacher_id" required
                  class="form-control @error('teacher_id') is-invalid @enderror">
            <option value="">— Pilih Guru —</option>
            @foreach ($teachers as $t)
              <option value="{{ $t->id }}" {{ old('teacher_id') == $t->id ? 'selected' : '' }}>
                {{ $t->name }}
              </option>
            @endforeach
          </select>
          @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <label for="schedule">Jadwal</label>
          <input type="text" name="schedule" id="schedule"
                 value="{{ old('schedule') }}" maxlength="100"
                 class="form-control @error('schedule') is-invalid @enderror"
                 placeholder="mis. Sabtu 15.00–17.00">
          @error('schedule') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <label for="description">Deskripsi</label>
          <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror"
                    placeholder="Kegiatan, tujuan, prestasi, dll.">{{ old('description') }}</textarea>
          @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-1"></i> Simpan
          </button>
          <a href="{{ route('extracurriculars.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
