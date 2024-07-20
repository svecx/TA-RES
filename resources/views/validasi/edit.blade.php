@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2>Edit Validasi</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('validasi.update', $validasi->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama_validasi">Nama Validasi</label>
            <input type="text" class="form-control" id="nama_validasi" name="nama_validasi" value="{{ $validasi->nama_validasi }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('validasi.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection