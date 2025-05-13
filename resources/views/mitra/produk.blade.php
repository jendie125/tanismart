@extends('layouts.mitra')
@section('content')
    <div class="container">
        <div class="row">
            {{-- Form Tambah Produk --}}
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Input Produk</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('mitra/produksimpan') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="namaproduk" class="form-label">Nama Produk:</label>
                                <input type="text" class="form-control" name="namaproduk" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi:</label>
                                <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Produk:</label>
                                <input type="file" class="form-control" name="gambar" accept="image/*" required>
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
                                        <tr>
                                            <td><input type="text" name="namavariasi[]" class="form-control" required>
                                            </td>
                                            <td><input type="number" name="hargavariasi[]" class="form-control" required>
                                            </td>
                                            <td><input type="number" name="stokvariasi[]" class="form-control" required>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>Tambah Produk
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
                                        <th>Deskripsi</th>
                                        <th>Variasi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($produk as $i => $p)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $p->namaproduk }}</td>
                                            <td>{{ substr($p->deskripsi, 0, 50) }}</td>
                                            <td>
                                                <img src="{{ asset('uploads/' . $p->gambar) }}" alt="Gambar Produk"
                                                    class="img-fluid" style="max-width: 100px;">
                                            </td>
                                            <td>
                                                @foreach ($p->produkdetail as $d)
                                                    <small>{{ $d->namavariasi }} (Rp{{ number_format($d->harga) }}, Stok:
                                                        {{ $d->stok }})</small><br>
                                                @endforeach
                                            </td>
                                            <td>
                                                <a href="{{ url('mitra/produkedit/' . $p->idproduk) }}"
                                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="{{ url('mitra/produkhapus/' . $p->idproduk) }}" method="POST"
                                                    style="display:inline-block;">
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
                <td><input type="number" name="hargavariasi[]" class="form-control" required></td>
                <td><input type="number" name="stokvariasi[]" class="form-control" required></td>
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
