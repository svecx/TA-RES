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
        <div class="container-fluid" >
        <div class="tab-content ms-md-5 ms-sm-0" id="v-pills-tabContent">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <h3>Kategori Dokumen</h3>
                <div>
                    <div class="col-sm-12"  style="height: 300px;">
                        <div class="card" style="margin-top:50px">
                            <div class="card-header">{{ __('Pilih Tipe Dokumen') }}</div>
                            <div class="card-body">
                                <form id="inputTypeForm">
                                    <div class="mb-3">
                                        <label for="inputType" class="form-label">Tipe Dokumen:</label>
                                        <select id="inputType" class="form-select" name="inputType" required>
                                            <option value="" disabled selected>Pilih tipe dokumen...</option>
                                            <option value="file">File</option>
                                            <option value="link">Link</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" id="submitInputType">Lanjutkan</button>
                            </div>
                    </div>
                <!-- </div> -->
            </div>
        </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('submitInputType').addEventListener('click', function() {
        var inputType = document.getElementById('inputType').value;
        if (inputType === 'file') {
            window.location.href = '{{ route("input-dokumen-file") }}';
        } else if (inputType === 'link') {
            window.location.href = '{{ route("input-dokumen-link") }}';
        } else {
            alert('Pilih tipe dokumen terlebih dahulu.');
        }
    });
</script>

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
