@extends('layouts.app')

@section('content')
<div class="navigasi" style="margin-top: 50px">
    <div class="d-flex align-items-start">
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
        <div class="tab-content" id="v-pills-tabContent" style=" width: calc(100% - 150px);">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <div class="container-fluid">
                <h3 class="judul m-0">List Role</h3><br>
                <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="fa fa-plus"></i> Tambah Role
                </button><br>
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Jabatan</th>
                                <th style="width: 10.5rem;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                            @foreach($jabatan as $item)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $item->nama_jabatan }}</td>
                                    <td>
                                        <a href="{{ route('jabatan.edit', $item->id) }}" class="btn btn-warning">Edit</a>
                                        <form action="{{ route('jabatan.destroy', $item->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal for Adding Category -->
                <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="{{ route('jabatan.store') }}" method="POST">
                            @csrf
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addModalLabel">Tambah Jabatan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama_jabatan">Nama Jabatan</label>
                                        <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<style>
    .nav-link.active {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border-radius: 4px;
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

    @media (max-width: 768px) {
        .d-flex.justify-content-between > div {
            width: 100% !important;
            margin-top: 0 !important;
            flex-basis: auto;
        }

        .d-flex.justify-content-between > div > div {
            width: 100% !important;
            flex-direction: column;
        }
    }
</style>
@endsection
