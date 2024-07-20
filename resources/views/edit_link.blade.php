@extends('layouts.app')

@section('content')
<div class="navigasi" style="margin-top:50px">
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
        <div class="tab-content" id="v-pills-tabContent">
            <div class="tab-pane fade show active" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                <h3>EDIT DOKUMEN LINK</h3>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('dokumen-link.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" value="PUT">
                    
                    <div>
                        <label>Judul Dokumen:</label>
                        <input class="form-control" name="judul_dokumen" value="{{ $document->judul_dokumen }}">
                    </div>
                    <div>
                        <label >Deskripsi Dokumen:</label>
                        <input class="form-control" name="deskripsi_dokumen" value="{{ $document->deskripsi_dokumen }}" >
                    </div>
                    <div style=" margin-top:10px">
                        <label>Kategori Dokumen:</label>
                        <select name="kategori_dokumen" id="kategoriDokumen" class="form-control" required>
                            <option value="">Memuat...</option>
                        </select>
                    </div>
                    <!-- validasi dokumen -->
                    <div style=" margin-top:10px">
                        <label>Validasi Dokumen:</label>
                        <select name="validasi_dokumen" id="validasiDokumen" class="form-control" required>
                            <option value="">Memuat...</option>
                        </select>
                    </div>
                    <div>
                        <label for="tahunDokumen">Tahun Dokumen:</label>
                        <input type="number" class="form-control" name="tahun_dokumen" value="{{ $document->tahun_dokumen }}" id="tahunDokumen" style=" position:relative; z-index: 1;" min="1900" max="2100" required>
                    </div>

                    <div id="linkInput" style=" margin-top:10px">
                        <label for="formLink">Input Link Dokumen:</label>
                        <input class="form-control" type="url" id="formLink" name="dokumen_link">
                        <div>
                            <small>Link yang sudah diunggah: {{ $document->dokumen_link}}</small>
                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="tags">Tags:</label>
                            <input type="text" id="tags" name="tags" data-role="tagsinput" class="form-control" value="{{ $document->tags }}" placeholder="Add tags">
                        </div>
                    </div>
        
                    <div>
                        <label for="permissions">Izinkan siapa saja yang melihat:</label>
                        <div class="row row-cols-3">
                            <div class="col-md-8" id="permissions-container">
                                <!-- Kontainer untuk checkbox lainnya -->
                            </div>
                        </div>
                    </div>


                    <button type="submit" class="btn btn-primary" style="margin-top:20px">Update</button>
                    <a href="{{ route('dokumen.edit', $document->id) }}" class="btn btn-primary" style="margin-left:10px; margin-top:20px">Update Into A File</a>
                    <button href="{{ route('list-dokumen') }}" class="btn btn-secondary" style="margin-left:10px; margin-top:20px">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
      document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route('kategori-dokumen') }}')
            .then(response => response.json())
            .then(data => {
                const kategoriDokumenSelect = document.getElementById('kategoriDokumen');
                kategoriDokumenSelect.innerHTML = '<option value="">Pilih Kategori Dokumen</option>'; // Reset options

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item.nama_dokumen;
                    option.textContent = item.nama_dokumen;
                    kategoriDokumenSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching kategori dokumen:', error);
                const kategoriDokumenSelect = document.getElementById('kategoriDokumen');
                kategoriDokumenSelect.innerHTML = '<option value="">Error memuat data</option>';
            });
    });

    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route('get-validasi-dokumen') }}')
            .then(response => response.json())
            .then(data => {
                const validasiDokumenSelect = document.getElementById('validasiDokumen');
                validasiDokumenSelect.innerHTML = '<option value="">Pilih Validasi Dokumen</option>'; // Reset options

                const currentValidasi = '{{ $document->validasi_dokumen }}';

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item;
                    option.textContent = item;

                    if (item === currentValidasi) {
                        option.selected = true;
                    }

                    validasiDokumenSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching validasi dokumen:', error);
                const validasiDokumenSelect = document.getElementById('validasiDokumen');
                validasiDokumenSelect.innerHTML = '<option value="">Error memuat data</option>';
            });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Fetch jabatan data
        fetch('{{ route('get-jabatan') }}')
            .then(response => response.json())
            .then(data => {
                const permissionsContainer = document.getElementById('permissions-container');
                permissionsContainer.innerHTML = ''; // Reset options

                // Convert $document->view to a JavaScript array
                let selectedPermissions = [];
                @if(isset($document->view))
                    selectedPermissions = {!! json_encode(explode(',', $document->view)) !!};
                @endif

                data.forEach(jabatan => {
                    const checkboxContainer = document.createElement('div');
                    checkboxContainer.classList.add('form-check');

                    const checkbox = document.createElement('input');
                    checkbox.classList.add('form-check-input');
                    checkbox.type = 'checkbox';
                    checkbox.name = 'permissions[]';
                    checkbox.value = jabatan.nama_jabatan; // Sesuaikan dengan field yang sesuai dari JSON response
                    checkbox.id = jabatan.nama_jabatan; // Sesuaikan dengan field yang sesuai dari JSON response

                    // Check if the current checkbox value is in the selectedPermissions array
                    if (selectedPermissions.includes(jabatan.nama_jabatan)) {
                        checkbox.checked = true;
                    }

                    const label = document.createElement('label');
                    label.classList.add('form-check-label');
                    label.htmlFor = jabatan.nama_jabatan; // Sesuaikan dengan field yang sesuai dari JSON response
                    label.textContent = jabatan.nama_jabatan; // Sesuaikan dengan field yang sesuai dari JSON response

                    checkboxContainer.appendChild(checkbox);
                    checkboxContainer.appendChild(label);
                    permissionsContainer.appendChild(checkboxContainer);
                });

                // Add event listeners after checkboxes are added
                addCheckboxEventListeners();
            })
            .catch(error => {
                console.error('Error fetching jabatan:', error);
            });
    });

    function addCheckboxEventListeners() {
        const checkboxes = document.querySelectorAll('input.form-check-input');

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const allCheckbox = document.querySelector('input.form-check-input[value="All"]');

                if (this.value === 'All') {
                    if (this.checked) {
                        checkboxes.forEach(cb => {
                            if (cb.value !== 'All') {
                                cb.checked = false;
                                cb.parentElement.style.display = 'none';
                            }
                        });
                    } else {
                        checkboxes.forEach(cb => {
                            cb.parentElement.style.display = 'block';
                        });
                    }
                } else {
                    if (this.checked) {
                        allCheckbox.checked = false;
                    }
                    checkboxes.forEach(cb => {
                        if (cb.value === 'All') {
                            cb.parentElement.style.display = 'block';
                        }
                    });
                }
            });
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
    fetch('{{ route('kategori-dokumen') }}')
        .then(response => response.json())
        .then(data => {
            const kategoriDokumenSelect = document.getElementById('kategoriDokumen');
            kategoriDokumenSelect.innerHTML = '<option value="">Pilih Kategori Dokumen</option>'; // Reset options

            // Ambil nilai kategori dokumen dari document
            const selectedKategoriDokumen = "{{ $document->kategori_dokumen }}";

            data.forEach(item => {
                const option = document.createElement('option');
                option.value = item.nama_dokumen;
                option.textContent = item.nama_dokumen;

                // Tambahkan kondisi selected
                if (item.nama_dokumen === selectedKategoriDokumen) {
                    option.selected = true;
                }

                kategoriDokumenSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching kategori dokumen:', error);
            const kategoriDokumenSelect = document.getElementById('kategoriDokumen');
            kategoriDokumenSelect.innerHTML = '<option value="">Error memuat data</option>';
        });
});

</script>

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
