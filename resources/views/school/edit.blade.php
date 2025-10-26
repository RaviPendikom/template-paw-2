@extends('layouts.admin')

@section('main-content')
<div class="container mt-4">
    <h4>School Settings</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('school.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">School Name</label>
            <input type="text" class="form-control" name="name" value="{{ old('name', $school->name) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Address</label>
            <textarea class="form-control" name="address" rows="2" required>{{ old('address', $school->address) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Phone</label>
            <input type="text" class="form-control" name="phone" value="{{ old('phone', $school->phone) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control" name="email" value="{{ old('email', $school->email) }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Logo</label>
            <input type="file" class="form-control" name="logo">
            @if($school->logo)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $school->logo) }}" alt="Logo" width="120">
                </div>
            @endif
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3">{{ old('description', $school->description) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
</div>
@endsection
