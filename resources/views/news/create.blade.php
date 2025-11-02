@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('main-content')
<div class="container-fluid">
  <!-- Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Tambah Berita</h1>
    <a href="{{ route('news.index') }}" class="btn btn-light border btn-sm">
      <i class="fas fa-arrow-left mr-1"></i> Kembali
    </a>
  </div>

  {{-- Errors --}}
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
      <h6 class="m-0 font-weight-bold text-primary">Form Berita</h6>
    </div>

    <div class="card-body">
      <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Judul --}}
        <div class="form-group">
          <label for="title">Judul <span class="text-danger">*</span></label>
          <input type="text" name="title" id="title"
                 class="form-control @error('title') is-invalid @enderror"
                 value="{{ old('title') }}" required maxlength="150">
          @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        {{-- Meta: tanggal, penulis, gambar --}}
        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="date">Tanggal</label>
            <input type="date" name="date" id="date"
                   class="form-control @error('date') is-invalid @enderror"
                   value="{{ old('date') }}">
            @error('date') <div class="invalid-feedback">{{ $message }}</div> @enderror
          </div>

          <div class="form-group col-md-4">
            <label for="image">Gambar Sampul</label>
            <div class="custom-file">
              <input type="file" name="image" id="image"
                     class="custom-file-input @error('image') is-invalid @enderror"
                     accept="image/*">
              <label class="custom-file-label" for="image">Pilih file...</label>
            </div>
            @error('image') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
          </div>
        </div>

        {{-- Isi Berita (CKEditor 5) --}}
        <div class="form-group">
          <label for="content">Isi Berita <span class="text-danger">*</span></label>
          <textarea name="content" id="isi-berita" rows="12"
                    class="form-control @error('content') is-invalid @enderror">{{ old('content') }}</textarea>
          @error('content') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="mt-3">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-save mr-1"></i> Simpan
          </button>
          <a href="{{ route('news.index') }}" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<!-- CKEditor 5 Classic via CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
  (function initRTE() {
    const el = document.getElementById('isi-berita');
    if (!el || el.dataset.ckeditorInited) return;

    ClassicEditor.create(el, {
      toolbar: [
        'undo','redo','|',
        'heading','|',
        'bold','italic','underline','|',
        'bulletedList','numberedList','|',
        'link','insertTable','blockQuote','codeBlock'
      ]
    }).then(() => { el.dataset.ckeditorInited = '1'; })
      .catch(console.error);
  })();

  // Update label input-file Bootstrap
  document.addEventListener('change', function(e){
    if (e.target && e.target.classList.contains('custom-file-input')) {
      e.target.nextElementSibling.textContent = e.target.files.length ? e.target.files[0].name : 'Pilih file...';
    }
  });
</script>
@endpush
