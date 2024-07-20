@extends('layouts.app')

@section('content')
<div class="navigasi" style="margin-top:50px">
    <div class="d-flex">
    <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
    <div class="position-sticky">
        <div class="collapse d-sm-none d-md-block" id="navbarNav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}" href="{{ route('home') }}" role="tab" aria-controls="v-pills-home" aria-selected="true">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'input-dokumen' ? 'active' : '' }}" id="v-pills-profile-tab" href="{{ route('input-dokumen') }}" role="tab" aria-controls="v-pills-profile" aria-selected="false">Input Dokumen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'list-dokumen' ? 'active' : '' }}" id="v-pills-list-dokumen-tab" href="{{ route('list-dokumen') }}" role="tab" aria-controls="v-pills-list-dokumen" aria-selected="false">List Dokumen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'list-dokumen-user' ? 'active' : '' }}" id="v-pills-list-dokumen-user-tab" href="{{ route('list-dokumen-user') }}" role="tab" aria-controls="v-pills-list-dokumen-user" aria-selected="false">Dokumen Saya</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'draft-dokumen' ? 'active' : '' }}" id="v-pills-draft-dokumen-tab" href="{{ route('draft-dokumen') }}" role="tab" aria-controls="v-pills-draft-dokumen" aria-selected="false">Deleted Dokumen</a>
                </li>
                @if(auth()->check() && auth()->user()->approved && (auth()->user()->jabatan === 'Admin'))
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'kategori-dokumen.index' ? 'active' : '' }}" id="v-pills-kategori-tab" href="{{ route('kategori-dokumen.index') }}" role="tab" aria-controls="v-pills-kategori" aria-selected="false">List Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'jabatan.index' ? 'active' : '' }}" id="v-pills-role-tab" href="{{ route('jabatan.index') }}" role="tab" aria-controls="v-pills-role" aria-selected="false">List Role</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'list-user' ? 'active' : '' }}" id="v-pills-user-tab" href="{{ route('list-user') }}" role="tab" aria-controls="v-pills-user" aria-selected="false">List User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'validasi.index' ? 'active' : '' }}" id="v-pills-validasi-tab" href="{{ route('validasi.index') }}" role="tab" aria-controls="v-pills-validasi" aria-selected="false">List Validasi</a>
                </li>
                @endif
                @if(auth()->check() && auth()->user()->jabatan === 'Kaprodi')
                <li class="nav-item">
                    <a class="nav-link {{ Route::currentRouteName() == 'list-user' ? 'active' : '' }}" id="v-pills-user-tab" href="{{ route('list-user') }}" role="tab" aria-controls="v-pills-user" aria-selected="false">List User</a>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
        <div class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <!-- Konten Draft Dokumen -->
            <h3>Deleted Dokumen</h3>
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
            <table class="table table-striped table-bordered w-100">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Judul Dokumen</th>
                        <th scope="col">Kategori Dokumen</th>
                        <th scope="col">Pembuat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($draftDokumens as $index => $dokumen)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $dokumen->judul_dokumen }}</td>
                            <td>{{ $dokumen->kategori_dokumen }}</td>
                            <td>{{ $dokumen->created_by }}</td>
                            <td>
                                <!-- Icon untuk delete -->
                                <div style="display: flex; align-items: center;">
                                    <form action="{{ route('draft.delete', $dokumen->id) }}" method="POST" style="margin-right: 5px;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border: none; background-color: transparent;" onclick="return confirm('Apakah Anda yakin ingin menghapus dokumen ini dari draft?')">
                                            <i class="fa fa-trash" aria-hidden="true" style="color: red;"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('draft-dokumen.unarchive', $dokumen->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" style="border: none; background-color: transparent;">
                                            <i class="fa fa-arrow-left" aria-hidden="true" style="color: blue;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
</div>
    </div>
</div>

<style>
    .nav-link.active {
        background-color: #007bff; /* Warna latar belakang ketika aktif */
        color: white; /* Warna teks ketika aktif */
        padding: 10px 15px; /* Sesuaikan padding agar sama dengan elemen navigasi lainnya */
        border-radius: 4px; /* Sesuaikan border-radius jika diperlukan */
        margin: 0;
    }
    .navbar-toggler-icon {
        background-image: none;
        width: 30px;
        height: 3px;
        background-color: black;
        display: inline-block;
        position: relative;
    }
    .navbar-toggler-icon::before,
    .navbar-toggler-icon::after {
        content: '';
        width: 30px;
        height: 3px;
        background-color: black;
        display: inline-block;
        position: absolute;
        left: 0;
    }
    .navbar-toggler-icon::before {
        top: -10px;
    }
    .navbar-toggler-icon::after {
        top: 10px;
    }
</style>
@endsection
