@extends('layouts.app')

@section('content')
@if(auth()->check() && (auth()->user()->jabatan === 'Kaprodi' || auth()->user()->jabatan === 'Admin'))
<div class="navigasi" style="margin-top: 50px">
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

        <!-- Konten Utama -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-4">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <h3 class="judul m-0">List of Users</h3>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Jabatan</th>
                                <th>Approve</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                        @foreach($users as $user)
                            @if(auth()->user()->jabatan !== 'Kaprodi' || $user->jabatan === 'Mahasiswa')
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->jabatan }}</td>
                                    <td>{{ $user->approved ? 'Diizinkan' : 'Tidak Diizinkan' }}</td>
                                    <td>
                                        <a href="{{ route('edit-user', $user->id) }}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('approve-user', $user->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('PUT')
                                            @if ($user->approved)
                                                <button type="submit" class="btn btn-danger">Cancel</button>
                                            @else
                                                <button type="submit" class="btn btn-success">Approve</button>
                                            @endif
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    @if(auth()->user()->jabatan === 'Kaprodi')
                        @php
                            $allApproved = $users->where('jabatan', 'Mahasiswa')->where('approved', false)->isEmpty();
                        @endphp
                        <form action="{{ $allApproved ? route('cancel-all') : route('approve-all') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success">{{ $allApproved ? 'Cancel All' : 'Approve All' }}</button>
                        </form>
                    @endif
                </div>
            </div>
        </main>
    </div>
</div>

@else
    <div class="alert alert-danger mt-5">
        You do not have permission to view this page.
    </div>
@endif

<style>
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

    .nav-link.active {
        background-color: #007bff; /* Warna latar belakang ketika aktif */
        color: white; /* Warna teks ketika aktif */
        padding: 10px 15px; /* Sesuaikan padding agar sama dengan elemen navigasi lainnya */
        border-radius: 4px; /* Sesuaikan border-radius jika diperlukan */
        margin: 0;
    }

    @media (max-width: 768px) {
        /* Menyusun sidebar dan konten dalam satu baris di perangkat kecil */
        .row {
            display: flex;
            flex-direction: row;
        }

        /* Menjaga ukuran tombol hamburger dan menempatkannya di sebelah kiri */
        #sidebar {
            flex: 1;
        }

        main {
            flex: 4;
        }
    }
</style>
@endsection
