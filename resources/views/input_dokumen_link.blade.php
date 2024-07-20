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
                <h3>FORM INPUT DOKUMEN</h3>
                <form action="{{ route('simpan-link') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div>
                        <img src="{{ asset('images/gambar2.png') }}" alt="gambar" style="position:absolute; top:7%; left:600px; opacity:0.2; max-width: 110%; height: 600px">
                    </div>
                    <div>
                        <label>Judul Dokumen:</label>
                        <input class="form-control" name="judul_dokumen"  required>
                    </div>

                    <div>
                        <label>Deskripsi Dokumen:</label>
                        <input class="form-control" name="deskripsi_dokumen">
                    </div>
                    <div style=" margin-top:10px">
                        <label>Kategori Dokumen:</label>
                        <select name="kategori_dokumen" id="kategoriDokumen" class="form-control" required>
                            <option value="">Memuat...</option>
                        </select>
                    </div>

                    <div style=" margin-top:10px">
                        <label>Validasi Dokumen:</label>
                        <select name="validasi_dokumen" id="validasiDokumen" class="form-control" required>
                            <option value="">Memuat...</option>
                        </select>
                    </div>

                    <div>
                        <label for="tahunDokumen" >Tahun Dokumen:</label>
                        <input type="number" class="form-control" name="tahun_dokumen" id="tahunDokumen" style=" position:relative; z-index: 1;" min="1900" max="2100" required>
                    </div>


                    <div id="linkInput" class="mb-3">
                        <label for="formLink">Input Link Dokumen:</label>
                        <input class="form-control" type="url" id="formLink" name="dokumen_link" value="{{ old('dokumen_link') }}">
                    </div>



                    <div>
                        <div>
                            <label for="tags">Tags:</label>
                            <input type="text" id="tags" name="tags" data-role="tagsinput" class="form-control" placeholder="Add tags" required>
                        </div>
                    </div>

                    <div >
                        <label for="permissions">Izinkan siapa saja yang melihat:</label>
                        <div class="row row-cols-3">
                            <div class="col-md-8" id="permissions-container">
                                <!-- Kontainer untuk checkbox lainnya -->
                            </div>
                        </div>
                    </div>

                    <div>
                        <div>
                            <label for="User">User:</label>
                            <input type="text" id="User" name="Create_by" class="form-control" placeholder="User" required disabled>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary" style="margin-top:20px">Submit</button>
                    <a href="{{ route('input-dokumen') }}" id="cancelButton" class="btn btn-secondary" style="margin-left:10px; margin-top:20px">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        function toggleInputFields() {
            var inputType = document.getElementById('inputType').value;
            var linkInput = document.getElementById('linkInput');

        }

        // Call toggleInputFields once to initialize based on the current selection
        toggleInputFields();

        // Add event listener to call toggleInputFields every time the dropdown value changes
        document.getElementById('inputType').addEventListener('change', toggleInputFields);
    });
    // Ambil nama pengguna dari server dan simpan di localStorage
    fetch('/get-user-name')
        .then(response => response.json())
        .then(data => {
            localStorage.setItem('user_active', data.name);

            // Ambil nama pengguna dari local storage
            var userName = localStorage.getItem('user_active');

            // Set nilai input dengan id 'Create_by' menjadi nilai nama pengguna dari local storage
            if (userName) {
                document.getElementById('User').value = userName; // Menggunakan 'User' sebagai id input
            }
        });

    fetch('/get-user-name')
        .then(response => response.json())
        .then(data => {
            localStorage.setItem('user_active', data.name);

            // Ambil nama pengguna dari local storage
            var userName = localStorage.getItem('user_active');

            // Set nilai input dengan id 'Create_by' menjadi nilai nama pengguna dari local storage
            if (userName) {
                document.getElementById('User').value = userName; // Menggunakan 'User' sebagai id input
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
    // Fetch jabatan data
    fetch('{{ route('get-jabatan') }}')
    .then(response => response.json())
    .then(data => {
        const permissionsContainer = document.getElementById('permissions-container');
        permissionsContainer.innerHTML = ''; // Reset options

        data.forEach(jabatan => {
            const checkboxContainer = document.createElement('div');
            checkboxContainer.classList.add('form-check');

            const checkbox = document.createElement('input');
            checkbox.classList.add('form-check-input');
            checkbox.type = 'checkbox';
            checkbox.name = 'permissions[]';
            checkbox.value = jabatan.nama_jabatan; // Sesuaikan dengan field yang sesuai dari JSON response
            checkbox.id = jabatan.nama_jabatan; // Sesuaikan dengan field yang sesuai dari JSON response

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
        fetch('{{ route('get-validasi-dokumen') }}') // Ganti dengan endpoint yang sesuai untuk mendapatkan data validasi dokumen
            .then(response => response.json())
            .then(data => {
                const validasiDokumenSelect = document.getElementById('validasiDokumen');
                validasiDokumenSelect.innerHTML = '<option value="">Pilih Validasi Dokumen</option>'; // Reset options

                data.forEach(item => {
                    const option = document.createElement('option');
                    option.value = item; // Sesuaikan dengan field yang sesuai dari JSON response
                    option.textContent = item; // Sesuaikan dengan field yang sesuai dari JSON response
                    validasiDokumenSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error fetching validasi dokumen:', error);
                const validasiDokumenSelect = document.getElementById('validasiDokumen');
                validasiDokumenSelect.innerHTML = '<option value="">Error memuat data</option>';
            });
    });
</script>

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
    .form-check-input {
        width: 20px;
        height: 20px;
        margin-right: 10px;
    }
    .custom-checkbox {
        width: 20px;
        height: 20px;
        margin-right: 10px;
        border: 2px solid #000; /* Membuat border lebih tebal */
        border-radius: 3px; /* Membuat sudut kotak checkbox melengkung */
        appearance: none; /* Menghilangkan tampilan default */
        -webkit-appearance: none; /* Menghilangkan tampilan default untuk browser Webkit */
        -moz-appearance: none; /* Menghilangkan tampilan default untuk browser Firefox */
    }
</style>
@endsection