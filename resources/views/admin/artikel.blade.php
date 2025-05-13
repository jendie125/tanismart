@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Input Artikel</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('admin/artikelsimpan') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Artikel:</label>
                                <input type="text" class="form-control" name="judul" required>
                                @error('judul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="konten" class="form-label">Konten:</label>
                                <textarea class="form-control" name="konten" rows="5" required></textarea>
                                @error('konten')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Upload Gambar Artikel:</label>
                                <input type="file" class="form-control" name="gambar" accept="image/*" required>
                                @error('gambar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="sumber" class="form-label">Sumber:</label>
                                <input type="text" class="form-control" name="sumber" required>
                                @error('sumber')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="url" class="form-label">URL:</label>
                                <input type="url" class="form-control" name="url" required>
                                @error('url')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" name="submit_artikel" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>Tambah Artikel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Artikel</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Konten</th>
                                        <th>Gambar</th>
                                        <th>Sumber</th>
                                        <th>URL</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($artikel as $key =>$value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value->judul }}</td>
                                            <td>{{ Str::limit($value->konten, 50) }}</td>
                                            <td><img src="{{ asset('uploads/' . $value->gambar) }}" alt="Gambar Artikel"
                                                    class="img-thumbnail"></td>
                                            <td>{{ $value->sumber }}</td>
                                            <td><a href="{{ $value->url }}" target="_blank">Buka</a></td>
                                            <td>
                                                <a href="{{ url('admin/artikeledit', $value->idartikel) }}"
                                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>

                                                <form action="{{ url('admin/artikelhapus/' . $value->idartikel) }}"
                                                    method="POST" style="display: inline-block">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                            class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada artikel yang tersedia.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            {{ $artikel->links('vendor.pagination.bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
