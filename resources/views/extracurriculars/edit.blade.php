@extends('layouts.admin')

@section('title', 'Ubah Ekstrakurikuler')

@section('main-content')
<div class="container-fluid">
  <!-- Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Ekstrakurikuler</h1>
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
      <form action="{{ route('extracurriculars.update', $extracurricular) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
          <label for="name">Nama <span class="text-danger">*</span></label>
          <input type="text" name="name" id="name" required maxlength="100"
                 value="{{ old('name', $extracurricular->name) }}"
                 class="form-control @error('name') is-invalid @enderror">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <label for="teacher_id">Guru Pembina <span class="text-danger">*</span></label>
          <select name="teacher_id" id="teacher_id" required
                  class="form-control @error('teacher_id') is-invalid @enderror">
            @foreach ($teachers as $t)
              <option value="{{ $t->id }}"
                {{ old('teacher_id', $extracurricular->teacher_id) == $t->id ? 'selected' : '' }}>
                {{ $t->name }}
              </option>
            @endforeach
          </select>
          @error('teacher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <label for="schedule">Jadwal</label>
          <input type="text" name="schedule" id="schedule" maxlength="100"
                 value="{{ old('schedule', $extracurricular->schedule) }}"
                 class="form-control @error('schedule') is-invalid @enderror">
          @error('schedule') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
          <label for="description">Deskripsi</label>
          <textarea name="description" id="description" rows="4"
                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $extracurricular->description) }}</textarea>
          @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-1"></i> Perbarui
          </button>
          <a href="{{ route('extracurriculars.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
