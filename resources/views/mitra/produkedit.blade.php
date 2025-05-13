@extends('layouts.mitra')
@section('content')
    <div class="container">
        <div class="row">
            {{-- Form Edit Produk --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Produk</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('mitra/produkupdate/' . $produkedit->idproduk) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Nama Produk:</label>
                                <input type="text" class="form-control" name="namaproduk"
                                    value="{{ $produkedit->namaproduk }}" required>
                                @error('namaproduk')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi:</label>
                                <textarea class="form-control" name="deskripsi" rows="3" required>{{ $produkedit->deskripsi }}</textarea>
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" class="form-control" name="gambar" accept="image/*">
                                <small class="text-danger">*Kosongkan jika tidak ingin mengganti gambar</small>
                                @error('gambar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- Variasi Produk --}}
                            <div class="mb-3">
                                <label class="form-label">Variasi Produk:</label>
                                <table class="table table-bordered" id="tabel-variasi">
                                    <thead>
                                        <tr>
                                            <th>Nama Variasi</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th><button type="button" class="btn btn-sm btn-success"
                                                    id="tambah-variasi">+</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($produkedit->produkdetail as $d)
                                            <tr>
                                                <input type="hidden" name="idprodukdetail[]"
                                                    value="{{ $d->idprodukdetail }}">
                                                <td><input type="text" name="namavariasi[]" value="{{ $d->namavariasi }}"
                                                        class="form-control" required></td>
                                                <td><input type="number" name="harga[]" value="{{ $d->harga }}"
                                                        class="form-control" required></td>
                                                <td><input type="number" name="stok[]" value="{{ $d->stok }}"
                                                        class="form-control" required></td>
                                                <td><button type="button"
                                                        class="btn btn-sm btn-danger hapus-baris">×</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-2"></i>Update Produk
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Daftar Produk --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Produk</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Variasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produk as $i => $p)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $p->namaproduk }}</td>
                                            <td>
                                                @foreach ($p->produkdetail as $d)
                                                    <small>{{ $d->namavariasi }} (Rp{{ number_format($d->harga) }}, Stok:
                                                        {{ $d->stok }})</small><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ url('mitra/produkedit/' . $p->idproduk) }}"
                                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ url('mitra/produkhapus/' . $p->idproduk) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Hapus produk ini?')"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada produk.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="text-center">{{ $produk->links('vendor.pagination.bootstrap-5') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.getElementById('tambah-variasi').addEventListener('click', function() {
            const tbody = document.querySelector('#tabel-variasi tbody');
            const row = document.createElement('tr');

            row.innerHTML = `
                <td><input type="text" name="namavariasi[]" class="form-control" required></td>
                <td><input type="number" name="harga[]" class="form-control" required></td>
                <td><input type="number" name="stok[]" class="form-control" required></td>
                <td><button type="button" class="btn btn-sm btn-danger hapus-baris">×</button></td>
            `;
            tbody.appendChild(row);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('hapus-baris')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
@endsection
