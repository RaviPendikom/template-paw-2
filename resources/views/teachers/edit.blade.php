@extends('layouts.admin')

@section('title', 'Ubah Guru')

@section('main-content')
<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ubah Guru</h1>
    <a href="{{ route('teachers.index') }}" class="btn btn-light border btn-sm">
      <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
  </div>

  {{-- Alert sukses (jika ada) --}}
  @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  @endif

  {{-- Validasi error --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <div class="font-weight-bold mb-1">Terjadi kesalahan:</div>
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="card shadow">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Form Ubah Guru</h6>
    </div>
    <div class="card-body">
      <form action="{{ route('teachers.update', $teacher) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="name">Nama <span class="text-danger">*</span></label>
            <input
              type="text"
              name="name"
              id="name"
              class="form-control @error('name') is-invalid @enderror"
              value="{{ old('name', $teacher->name) }}"
              required
              maxlength="100">
            @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group col-md-6">
            <label for="employee_number">NIP/NUPTK <span class="text-danger">*</span></label>
            <input
              type="text"
              name="employee_number"
              id="employee_number"
              class="form-control @error('employee_number') is-invalid @enderror"
              value="{{ old('employee_number', $teacher->employee_number) }}"
              required
              maxlength="50">
            @error('employee_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="email">Email</label>
            <input
              type="email"
              name="email"
              id="email"
              class="form-control @error('email') is-invalid @enderror"
              value="{{ old('email', $teacher->email) }}"
              maxlength="100"
              placeholder="opsional">
            @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group col-md-6">
            <label for="position">Jabatan</label>
            <input
              type="text"
              name="position"
              id="position"
              class="form-control @error('position') is-invalid @enderror"
              value="{{ old('position', $teacher->position) }}"
              maxlength="100"
              placeholder="opsional">
            @error('position') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="photo">Ganti Foto (jpg/png, maks 2MB)</label>
            <div class="custom-file">
              <input
                type="file"
                name="photo"
                id="photo"
                class="custom-file-input @error('photo') is-invalid @enderror"
                accept="image/*">
              <label class="custom-file-label" for="photo">Pilih file...</label>
            </div>
            @error('photo') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror

            @if ($teacher->photo)
              <div class="mt-3">
                <div class="text-muted small mb-1">Foto saat ini:</div>
                <img src="{{ asset('storage/'.$teacher->photo) }}" alt="foto" class="img-thumbnail" style="height: 110px; object-fit: cover;">
              </div>
            @else
              <div class="mt-3">
                <div class="text-muted small mb-1">Tidak ada foto, pratinjau avatar:</div>
                <img src="https://ui-avatars.com/api/?name={{ urlencode($teacher->name) }}&size=128" class="img-thumbnail" style="height: 110px; object-fit: cover;">
              </div>
            @endif
          </div>
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-1"></i> Perbarui
          </button>
          <a href="{{ route('teachers.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
// Update label pada input file (Bootstrap custom-file-input)
document.addEventListener('change', function(e){
  if (e.target && e.target.classList.contains('custom-file-input')) {
    const label = e.target.nextElementSibling;
    label.textContent = e.target.files.length ? e.target.files[0].name : 'Pilih file...';
  }
});
</script>
@endpush
