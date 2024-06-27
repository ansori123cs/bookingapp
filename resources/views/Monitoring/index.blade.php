@extends('layouts._layoutManager')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between py-3">
                    <h2 class="mb-sm-0">Manajemen Data Kost</h2>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#formModal">
                    Tambah Data
                </button>
                @if (session()->has('success'))
                    <script>
                        Swal.fire({
                            title: "Success!",
                            text: "{{ session()->get('success') }}",
                            icon: "success"
                        });
                    </script>
                @endif

                @if ($errors->any())
                    <div class="col">
                        @foreach ($errors->all() as $error)
                            <script>
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: "{{ $error }}"
                                });
                            </script>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
        <hr>
        <div class="container table table-striped table-hover table-responsive mt-2">
            <table id="myTable" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kost</th>
                        <th>Fasilitas</th>
                        <th>Jenis</th>
                        <th>Harga</th>
                        <th>Rating</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($kost as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>{{ $item->nama_kost }}</td>

                            <td>{{ $item->fasilitas }}</td>

                            <td>{{ $item->jenis }}</td>

                            <td>{{ $item->harga }}</td>

                            <td>{{ $item->rating }}</td>

                            <td class="d-flex justify-content-around">
                                <div>
                                    <button type="button" class="btn btn-warning text-light me-1" data-bs-toggle="modal"
                                        data-bs-target="#editModal{{ $item->id }}"><i class="bi bi-pencil-square"></i>
                                        Edit</button>
                                </div>
                                <div>
                                    <form action="{{ route('kost.deleteDataKost', $item->id) }}" method="post"
                                        id="deleteForm{{ $index }}">
                                        @csrf
                                        <button type="button"
                                            class="btn btn-danger text-light"onclick="deletepro({{ $index }})"><i
                                                class="bi bi-trash"></i>
                                            Hapus</button>
                                    </form>
                                </div>
                            </td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
        <hr class="mt-5">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between py-3">
                    <h2 class="mb-sm-0">Manajemen Data Booking</h2>
                </div>
            </div>
        </div>
        <hr>
        <div class="container table table-striped table-hover table-responsive mt-3">
            <table id="myTable2" class="display">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pemesan</th>
                        <th>No HP</th>
                        <th>Pesan Khusus</th>

                    </tr>
                </thead>
                <tbody>

                    @foreach ($booking as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>{{ $item->nama_pemesan }}</td>

                            <td>{{ $item->no_hp }}</td>

                            <td>{{ $item->pesan_khusus }}</td>

                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

        {{-- FormModal --}}
        <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="formModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formModalLabel">Form Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kost.addDataKost') }}" method="post" id="addForm">
                            @csrf
                            <div class="mb-3">
                                <label for="nama_kost" class="form-label">Nama Kost</label>
                                <input type="text" class="form-control" id="nama_kost" name="nama_kost" required>
                            </div>
                            <div class="mb-3">
                                <label for="fasilitas" class="form-label">Fasilitas</label>
                                <input type="text" class="form-control" id="fasilitas" name="fasilitas" required>
                            </div>
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis</label>
                                <input type="text" class="form-control" id="jenis" name="jenis" required>
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" step="0.01" class="form-control" id="harga" name="harga"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <input type="number" class="form-control" id="rating" name="rating" min="1"
                                    max="5" required>
                            </div>
                            <button type="button" onclick="add();" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                    <!-- Tombol tutup di luar tag form -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- end of FormModal --}}
        {{-- editModal --}}

        <!-- Form Modal Edit -->
        @foreach ($kost as $index => $item)
            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Form Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('kost.editDataKost', $item->id) }}"
                                method="post"id="editForm{{ $index }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama_kost" class="form-label">Nama Kost</label>
                                    <input type="text" class="form-control" id="nama_kost" name="nama_kost"
                                        value="{{ $item->nama_kost }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="fasilitas" class="form-label">Fasilitas</label>
                                    <input type="text" class="form-control" id="fasilitas" name="fasilitas"
                                        value="{{ $item->fasilitas }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jenis" class="form-label">Jenis</label>
                                    <input type="text" class="form-control" id="jenis" name="jenis"
                                        value="{{ $item->jenis }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="harga" class="form-label">Harga</label>
                                    <input type="number" step="0.01" class="form-control" id="harga"
                                        name="harga" value="{{ $item->harga }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating</label>
                                    <input type="number" class="form-control" id="rating" name="rating"
                                        value="{{ $item->rating }}" min="1" max="5" required>
                                </div>
                                <!-- Tombol simpan berada di dalam tag form -->
                                <button type="button" onclick="edit({{ $index }})"
                                    class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                        <!-- Tombol tutup di luar tag form -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- end of edit modal --}}
        <script>
            $(document).ready(function() {
                document.title = "KostInAja";
                $('#myTable').DataTable({
                    responsive: true,
                    searching: true,
                    "ordering": false
                });
                $('#myTable2').DataTable({
                    responsive: true,
                    searching: true,
                    "ordering": false
                });
                //bug search
                $(window).keydown(function(event) {
                    if (event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                    }
                });
            });
            // check
            function add() {
                Swal.fire({
                    title: "Apa Kamu Yakin?",
                    text: "Pastikan Inputan Sudah Benar!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Kirim!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#addForm').submit();
                    }
                });
            }

            function edit(id) {
                Swal.fire({
                    title: "Apa Kamu Yakin?",
                    text: "Pastikan Inputan Sudah Benar!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Kirim!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#editForm' + id).submit();
                    }
                });
            }

            function deletepro(id) {
                Swal.fire({
                    title: "Apa Kamu Yakin Menghapus Data ini?",
                    text: "Pastikan Data Yang Dihapus Sudah Benar!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, Hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#deleteForm' + id).submit();
                    }
                });
            }
        </script>

    @stop
